<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_lengkap')->nullable();
            $table->integer('usia')->nullable();
            $table->string('alamat')->nullable();
            $table->string('golongan_darah')->nullable(); // A, B, O, AB
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_lengkap', 'usia', 'alamat', 'golongan_darah', 'role']);
        });
    }
};
