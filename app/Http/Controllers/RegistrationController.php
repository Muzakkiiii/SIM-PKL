<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Company;
use App\Models\Placement;

class RegistrationController extends Controller
{
    // 1. Method untuk MENAMPILKAN formulir (GET)
    public function index()
    {
        // Kita perlu mengambil daftar perusahaan agar siswa bisa memilih di dropdown
        $companies = Company::all(); 
        
        // Tampilkan file view (kita buat nanti di langkah 3)
        return view('registration.form', compact('companies'));
    }

    // 2. Method untuk MENYIMPAN data (POST)
    public function store(Request $request)
    {
        // A. VALIDASI: Cek apakah isian formulir sudah benar?
        $request->validate([
            'nis' => 'required|numeric|unique:students,nis', // Wajib, Angka, Tidak boleh ada NIS kembar
            'name' => 'required|string|max:255',
            'class_name' => 'required|string',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id', // Perusahaan yang dipilih harus ada di database
        ]);

        // B. SIMPAN DATA SISWA
        // Kita simpan dulu siswanya untuk mendapatkan ID baru
        $student = Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'class_name' => $request->class_name,
            'phone' => $request->phone,
        ]);

        // C. SIMPAN DATA PENEMPATAN (Otomatis status Pending)
        Placement::create([
            'student_id' => $student->id, // Ambil ID dari siswa yang barusan dibuat
            'company_id' => $request->company_id,
            'status' => 'pending', // Default status: Menunggu persetujuan Admin
            // Tanggal mulai/selesai dikosongkan dulu, diisi nanti oleh Admin
        ]);

        // D. KEMBALIKAN KE HALAMAN DEPAN dengan Pesan Sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan tunggu verifikasi Admin.');
    }
}