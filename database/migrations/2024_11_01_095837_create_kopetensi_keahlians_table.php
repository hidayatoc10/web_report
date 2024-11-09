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
        Schema::create('kopetensi_keahlians', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_KK', 10)->unique();
            $table->char('Kode_mata_diklat', 10);
            $table->string('Nama_kompetensi_keahlian', 50);
            $table->foreign('Kode_mata_diklat')->references('Kode_mata_diklat')->on('meta_diklats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kopetensi_keahlians');
    }
};
