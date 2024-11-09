<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('standar_kopetensis', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_SK', 10)->unique();
            $table->char('Kode_KK', 10);
            $table->string('Nama_SK', 50);
            $table->string('Kelas_SK', 10);
            $table->foreign('Kode_KK')->references('Kode_KK')->on('kopetensi_keahlians')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_kopetensis');
    }
};
