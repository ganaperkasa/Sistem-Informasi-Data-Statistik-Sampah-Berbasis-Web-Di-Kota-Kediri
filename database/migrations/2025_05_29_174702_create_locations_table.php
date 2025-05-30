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
    Schema::create('locations', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama lokasi (optional)
        $table->decimal('latitude', 10, 8); // Format: -7.80921164
        $table->decimal('longitude', 11, 8); // Format: 111.98517590
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
