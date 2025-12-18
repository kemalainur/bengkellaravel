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
        // Check if detail table has id column, if not add it
        if (!Schema::hasColumn('detail', 'id')) {
            DB::statement('ALTER TABLE detail ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop id column if exists
        if (Schema::hasColumn('detail', 'id')) {
            Schema::table('detail', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
    }
};
