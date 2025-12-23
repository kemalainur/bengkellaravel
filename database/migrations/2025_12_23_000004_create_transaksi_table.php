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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('nostruk', 30)->primary();
            $table->string('nopolisi', 20);
            $table->date('tanggal');
            $table->string('totalbiaya', 50)->default('0');
            $table->string('terbilang', 255)->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');

            $table->foreign('nopolisi')
                  ->references('nopolisi')
                  ->on('motor')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
