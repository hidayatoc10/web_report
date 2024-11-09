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
        Schema::create('wali_murids', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_wali', 10)->unique();
            $table->char('NISN', 10);
            $table->string('Nama_ayah', 50);
            $table->string('Pekerjaan_ayah', 50)->nullable();
            $table->string('Nama_ibu', 50);
            $table->string('Pekerjaan_ibu', 50)->nullable();
            $table->string('Alamat_wali', 100);
            $table->string('Telp_wali', 15)->nullable();
            $table->foreign('NISN')->references('NISN')->on('siswas')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_murids');
    }
};
