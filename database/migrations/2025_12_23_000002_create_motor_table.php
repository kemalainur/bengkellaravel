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
        Schema::create('motor', function (Blueprint $table) {
            $table->string('nopolisi', 20)->primary();
            $table->string('idpelanggan', 20);
            $table->string('nomesin', 50)->nullable();
            $table->string('tipe', 100)->nullable();
            $table->string('tahun', 10)->nullable();
            $table->string('norangka', 50)->nullable();

            $table->foreign('idpelanggan')
                  ->references('idpelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
