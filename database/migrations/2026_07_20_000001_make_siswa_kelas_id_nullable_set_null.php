<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
        });

        DB::statement('ALTER TABLE siswa MODIFY kelas_id BIGINT UNSIGNED NULL');

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
        });

        DB::statement('ALTER TABLE siswa MODIFY kelas_id BIGINT UNSIGNED NOT NULL');

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade');
        });
    }
};
