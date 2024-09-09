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
        Schema::create('order_documentation_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('documentation_services_id');
            $table->unsignedBigInteger('dcumentation_prices_id');
            $table->string('selected_option');
            $table->decimal('price', 10, 2);
            $table->date('date');
            $table->time('time');
            $table->integer('pax');
            $table->string('location');
            $table->string('location_detail');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_documentation_services');
    }
};
