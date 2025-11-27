<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konfirmasi_donor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendonor');   // FK users
            $table->unsignedBigInteger('id_permohonan'); // FK permohonan_darah
            $table->string('lokasi_donor');
            $table->date('tanggal_donor');
            $table->time('waktu_donor');
            $table->string('status')->default('menunggu'); // menunggu, diterima, batal
            $table->timestamps();

            $table->foreign('id_pendonor')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_permohonan')
                  ->references('id')->on('permohonan_darah')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konfirmasi_donor');
    }
};
