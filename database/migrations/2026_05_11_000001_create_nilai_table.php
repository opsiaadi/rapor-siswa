<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->string('semester'); // 1 atau 2
            $table->decimal('harian', 5, 2)->nullable();
            $table->decimal('uts', 5, 2)->nullable();
            $table->decimal('uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->timestamps();

            $table->unique(['siswa_id', 'mapel_id', 'semester'], 'nilai_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};