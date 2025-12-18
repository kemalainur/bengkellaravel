<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix totalbiaya column to support larger numbers (was VARCHAR(10), now VARCHAR(50))
     */
    public function up(): void
    {
        // Increase totalbiaya column size to handle larger numbers
        DB::statement('ALTER TABLE transaksi MODIFY totalbiaya VARCHAR(50) NOT NULL');
        
        // Also fix detail hargatotal if needed (already VARCHAR(50) but let's ensure it)
        DB::statement('ALTER TABLE detail MODIFY hargatotal VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback is risky as it could truncate data
        // DB::statement('ALTER TABLE transaksi MODIFY totalbiaya VARCHAR(10) NOT NULL');
    }
};
