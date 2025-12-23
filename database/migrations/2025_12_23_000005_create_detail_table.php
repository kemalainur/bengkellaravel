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
        Schema::create('detail', function (Blueprint $table) {
            $table->id();
            $table->string('nostruk', 30);
            $table->string('iditem', 20);
            $table->integer('banyaknya')->default(1);
            $table->string('hargatotal', 50)->default('0');

            $table->foreign('nostruk')
                  ->references('nostruk')
                  ->on('transaksi')
                  ->onDelete('cascade');

            $table->foreign('iditem')
                  ->references('iditem')
                  ->on('item')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail');
    }
};
