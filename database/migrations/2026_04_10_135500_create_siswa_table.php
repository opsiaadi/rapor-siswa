<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tahun_ajaran');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('ket_kegiatan')->nullable();
            $table->integer('izin')->default(0);
            $table->integer('sakit')->default(0);
            $table->integer('alpha')->default(0);
            $table->enum('status_rapor', ['belum', 'sudah'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
