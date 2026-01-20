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
    Schema::create('placements', function (Blueprint $table) {
        $table->id();
        
        // RELASI: Menghubungkan ke tabel students & companies
        // onDelete('cascade') berarti jika siswa dihapus, data magangnya ikut terhapus otomatis.
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
        
        $table->date('start_date')->nullable(); // Tanggal Mulai
        $table->date('end_date')->nullable();   // Tanggal Selesai
        
        // Status pengajuan: pending (baru daftar), approved (disetujui admin), rejected (ditolak)
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        
        $table->string('letter_number')->nullable(); // Nomor Surat (diisi nanti saat cetak)
        
        $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
