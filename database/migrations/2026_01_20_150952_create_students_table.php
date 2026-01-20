<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('students', function (Blueprint $table) {
        $table->id(); // ID unik otomatis (Primary Key)
        $table->string('nis')->unique(); // Nomor Induk Siswa (Tidak boleh sama)
        $table->string('name');
        $table->string('class_name'); // Misal: "XII RPL 1"
        $table->string('phone')->nullable(); // Boleh kosong jika tidak punya HP
        $table->timestamps(); // Mencatat kapan data dibuat & diupdate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
