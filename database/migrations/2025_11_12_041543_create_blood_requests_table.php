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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users'); // requester (family/RS)
            $table->string('patient_name')->nullable();
            $table->string('blood_type');
            $table->integer('amount'); // jumlah kantong
            $table->foreignId('hospital_id')
                  ->constrained('hospitals')
                  ->OnDelete('cascade');
            $table->enum('status',['waiting','processing','matched','fulfilled','rejected'])->default('waiting');
            $table->text('notes')->nullable();
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
