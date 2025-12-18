<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix motor table - change nomesin to VARCHAR if it's INT
        // Using raw SQL because Laravel doesn't handle column type changes well
        DB::statement('ALTER TABLE motor MODIFY nomesin VARCHAR(50) NULL');
        DB::statement('ALTER TABLE motor MODIFY norangka VARCHAR(50) NULL');
        DB::statement('ALTER TABLE motor MODIFY tipe VARCHAR(100) NULL');
        DB::statement('ALTER TABLE motor MODIFY tahun VARCHAR(10) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes (be careful - this may cause data loss)
        DB::statement('ALTER TABLE motor MODIFY nomesin INT NULL');
        DB::statement('ALTER TABLE motor MODIFY norangka INT NULL');
    }
};
