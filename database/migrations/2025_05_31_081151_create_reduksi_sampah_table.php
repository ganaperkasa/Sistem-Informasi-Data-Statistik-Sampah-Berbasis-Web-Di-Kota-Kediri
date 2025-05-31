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
        Schema::create('reduksi_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->date('reduction_date');
            $table->decimal('sampah_masuk', 8, 2);
            $table->decimal('sampah_keluar', 8, 2);
            $table->decimal('reduksi_kg', 8, 2);
            $table->decimal('persentase_reduksi', 5, 2);
            $table->timestamps();

            $table->unique(['location_id', 'reduction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reduksi_sampah');
    }
};
