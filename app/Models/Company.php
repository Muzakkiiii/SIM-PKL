<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'director_name',
        'phone',
    ];

    // Relationship: One-to-Many
    // "Satu Perusahaan BISA MEMILIKI Banyak Penempatan Siswa"
    public function placements()
    {
        return $this->hasMany(Placement::class);
    }
}