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
        Schema::create('pembayaran_gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gaji_id')->constrained('gaji')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran')->nullable(); // path ke file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_gaji');
    }
};
