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
        Schema::create('permohonan_darah', function (Blueprint $table) {
            $table->id(); // id (PK)

            $table->unsignedBigInteger('id_penerima'); // id_penerima
            $table->string('golongan_darah', 255);     // golongan_darah
            $table->string('lokasi_rumah_sakit', 255); // lokasi_rumah_sakit
            $table->text('keterangan')->nullable();    // keterangan
            $table->string('status', 255);             // status: menunggu / selesai / dll

            $table->timestamps(); // created_at, updated_at

            // Jika ada relasi ke tabel penerima (opsional)
            // $table->foreign('id_penerima')->references('id')->on('penerima')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_darah');
    }
};
