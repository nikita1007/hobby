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
        Schema::create('ref_rooms_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('ref_rooms');
            $table->foreignId('image_id')->constrained('ref_images');
            $table->integer('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_rooms_images');
    }
};