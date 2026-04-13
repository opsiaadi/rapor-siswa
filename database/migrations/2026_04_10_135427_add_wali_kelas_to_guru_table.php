<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Wali kelas relationship is handled via kelas.wali_kelas_id -> guru.id
        // This migration is intentionally left empty but kept for tracking purposes
    }

    public function down(): void
    {
        // Nothing to rollback
    }
};
