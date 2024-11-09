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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->char('Kode_guru', 10)->unique();
            $table->char('Kode_KK', 10);
            $table->string('Nama_guru', 50);
            $table->char('NIP', 18)->nullable();
            $table->string('Alamat_guru', 100);
            $table->string('Telp_guru', 15)->nullable();
            $table->foreign('Kode_KK')->references('Kode_KK')->on('kopetensi_keahlians')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
