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
                // id, location_id, jumlah pekerja, luas, jam operasional, kapasitas tps, fasilitas, foto lokasi, ulasan
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locations_id')->nullable();
            $table->integer('jumlah_pekerja')->nullable();
            $table->decimal('luas', 8, 2)->nullable();
            $table->string('jam_operasional')->nullable();
            $table->integer('kapasitas_tps')->nullable();
            $table->text('fasilitas')->nullable();
            $table->string('foto_lokasi')->nullable();
            $table->text('ulasan')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('locations_id')->references('id')->on('locations')->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
