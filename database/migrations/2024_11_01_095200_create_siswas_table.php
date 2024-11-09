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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->char('NISN', 10)->unique();
            $table->char('Kode_KK', 10);
            $table->string('Nama_siswa', 50);
            $table->string('Alamat_siswa', 100);
            $table->date('Tgl_lahir');
            $table->string('Foto_siswa', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
