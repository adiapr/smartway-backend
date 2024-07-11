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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('location_id');
            $table->string('category');
            $table->string('transmission');
            $table->integer('start_price');
            $table->integer('price');
            $table->string('ratings');
            $table->integer('reviews_count');
            $table->integer('passenger_count');
            $table->integer('luggage_count');
            $table->integer('mileage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
