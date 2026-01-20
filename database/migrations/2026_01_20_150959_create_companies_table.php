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
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Perusahaan
        $table->text('address'); // Alamat lengkap (Text muat lebih banyak karakter)
        $table->string('director_name')->nullable(); // Nama Pimpinan untuk di Surat Pengantar
        $table->string('phone')->nullable();
        $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
