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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string("subject",30);
            $table->text('pertanyaan');
            $table->text('jawaban');
            $table->date('tgl_konsultasi');
            $table->foreignId('id_pasien')->constrained('pasien')->cascadeOnDelete();
            $table->foreignId('id_dokter')->constrained('dokter')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
