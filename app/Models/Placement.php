<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'company_id',
        'start_date',
        'end_date',
        'status',
        'letter_number',
    ];

    // Relationship: Inverse (Kebalikan)
    // "Data Penempatan ini MILIK Satu Siswa"
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // "Data Penempatan ini MILIK Satu Perusahaan"
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}