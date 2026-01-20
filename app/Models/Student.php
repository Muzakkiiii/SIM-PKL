<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // 1. Mass Assignment Protection (Keamanan)
    // Kolom-kolom ini yang boleh diisi secara massal lewat formulir
    protected $fillable = [
        'nis',
        'name',
        'class_name',
        'phone',
    ];

    // 2. Relationship: One-to-Many
    // "Satu Siswa BISA MEMILIKI Banyak Riwayat Penempatan"
    // (Meski biasanya cuma 1 kali PKL, kita pakai hasMany untuk jaga-jaga ada riwayat/pindah)
    public function placements()
    {
        return $this->hasMany(Placement::class);
    }
}