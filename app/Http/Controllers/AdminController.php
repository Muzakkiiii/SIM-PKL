<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http; // Memanggil Http Client untuk AI
use Illuminate\Http\Request;
use App\Models\Placement; // Memantau tabel penempatan
use Barryvdh\DomPDF\Facade\Pdf; // Memanggil alat cetak PDF

class AdminController extends Controller
{
    // 1. Halaman Dashboard Admin
    public function index()
    {
        $placements = Placement::with(['student', 'company'])->latest()->get();
        return view('admin.dashboard', compact('placements'));
    }

    // 2. Proses Simpan Perubahan Verifikasi (ACC/Tolak)
    public function update(Request $request, $id)
    {
        $placement = Placement::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'letter_number' => 'nullable|string',
        ]);

        $placement->update([
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'letter_number' => $request->letter_number,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diverifikasi!');
    }

    // 3. Cetak Surat Pengantar PDF
    public function printLetter($id)
    {
        $placement = Placement::with(['student', 'company'])->findOrFail($id);

        if ($placement->status != 'approved') {
            return back()->with('error', 'Data belum disetujui, surat tidak bisa dicetak.');
        }

        $pdf = Pdf::loadView('admin.letter', compact('placement'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Surat_Pengantar_' . $placement->student->nis . '.pdf');
    }

    // 4. Halaman Form Verifikasi (SUDAH TERINTEGRASI AI 🤖)
    public function edit($id)
    {
        // Ambil data penempatan siswa
        $placement = Placement::with(['student', 'company'])->findOrFail($id);

        // Hitung durasi PKL (Default 4 bulan jika belum diisi)
        $lama_pkl = 4;
        if ($placement->start_date && $placement->end_date) {
            $start = \Carbon\Carbon::parse($placement->start_date);
            $end = \Carbon\Carbon::parse($placement->end_date);
            $lama_pkl = max(1, $start->diffInMonths($end));
        }

        // Penyelarasan Nama Jurusan ke format Kamus AI
        $kelas_siswa = strtoupper($placement->student->class_name);
        if (str_contains($kelas_siswa, 'TKR')) {
            $jurusan_ai = 'TEKNIK KENDARAAN RINGAN';
        } elseif (str_contains($kelas_siswa, 'AKL') || str_contains($kelas_siswa, 'AKUN')) {
            $jurusan_ai = 'AKUNTANSI KEUANGAN LEMBAGA';
        } elseif (str_contains($kelas_siswa, 'TEI') || str_contains($kelas_siswa, 'ELIND')) {
            $jurusan_ai = 'TEKNIK ELEKTRONIKA INDUSTRI';
        } elseif (str_contains($kelas_siswa, 'MLOG') || str_contains($kelas_siswa, 'LOG')) {
            $jurusan_ai = 'MANAGEMEN LOGISTIC';
        } else {
            // Jika tidak ada yang cocok, gunakan fallback default yang ada di dataset Anda
            $jurusan_ai = 'TEKNIK KENDARAAN RINGAN'; 
        }

        // Minta Prediksi ke Server Python Flask
        try {
            $response = Http::timeout(5)->post('http://127.0.0.1:5000/predict', [
                'lama_pkl' => $lama_pkl,
                'nama_perusahaan' => $placement->company->name,
                'jurusan' => $jurusan_ai
            ]);

            if ($response->successful()) {
                $ai_prediction = $response->json()['prediksi'];
            } else {
                $ai_prediction = 'Gagal Mengambil Prediksi (Data Tidak Dikenali AI)';
            }
        } catch (\Exception $e) {
            $ai_prediction = 'Server AI Tidak Aktif';
        }

        // Kirim semua variabel ke view admin.edit
        return view('admin.edit', compact('placement', 'ai_prediction', 'lama_pkl'));
    }
}