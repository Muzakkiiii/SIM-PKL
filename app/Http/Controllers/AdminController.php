<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placement; // Kita akan memantau tabel penempatan
use Barryvdh\DomPDF\Facade\Pdf; // PENTING: Memanggil alat PDF

class AdminController extends Controller
{
    public function index()
    {
        // AMBIL DATA
        // with(['student', 'company']) -> ini teknik Eager Loading tadi.
        // latest() -> urutkan dari yang paling baru masuk.
        $placements = Placement::with(['student', 'company'])->latest()->get();

        return view('admin.dashboard', compact('placements'));
    }
    // 1. Tampilkan Halaman Form Edit
    public function edit($id)
    {
        // Cari data penempatan berdasarkan ID, kalau tidak ada, tampilkan error 404
        $placement = Placement::with(['student', 'company'])->findOrFail($id);

        return view('admin.edit', compact('placement'));
    }

    // 2. Proses Simpan Perubahan
    public function update(Request $request, $id)
    {
        $placement = Placement::findOrFail($id);

        // Validasi Input Admin
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'start_date' => 'nullable|date',
            // Tanggal selesai harus setelah tanggal mulai (after_or_equal)
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'letter_number' => 'nullable|string',
        ]);

        // Update data di database
        $placement->update([
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'letter_number' => $request->letter_number,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diverifikasi!');
    }
    public function printLetter($id)
    {
        // 1. Ambil Data
        $placement = Placement::with(['student', 'company'])->findOrFail($id);

        // 2. Cek Keamanan: Kalau belum disetujui, jangan boleh cetak surat
        if ($placement->status != 'approved') {
            return back()->with('error', 'Data belum disetujui, surat tidak bisa dicetak.');
        }

        // 3. Siapkan Kertas PDF
        // Kita akan membuat view baru bernama 'admin.letter'
        $pdf = Pdf::loadView('admin.letter', compact('placement'));

        // 4. Atur ukuran kertas ke A4 (opsional, defaultnya A4)
        $pdf->setPaper('a4', 'portrait');

        // 5. Tampilkan PDF di browser (Stream)
        // Kalau mau langsung download, ganti stream() jadi download()
        return $pdf->stream('Surat_Pengantar_' . $placement->student->nis . '.pdf');
    }
}