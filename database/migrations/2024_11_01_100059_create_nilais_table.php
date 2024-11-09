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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->char('NISN', 10)->unique();
            $table->char('Kode_guru', 10)->unique();
            $table->char('Kode_SK', 10)->unique();
            $table->decimal('Nilai_angka', 5, 2);
            $table->char('Nilai_huruf', 2);
            $table->foreign('NISN')->references('NISN')->on('siswas')->onDelete('cascade');
            $table->foreign('Kode_guru')->references('Kode_guru')->on('guru')->onDelete('cascade');
            $table->foreign('Kode_SK')->references('Kode_SK')->on('standar_kopetensis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
