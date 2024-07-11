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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->tinyInteger('metode')->comment('1. Manual, 2. Otomatis');
            $table->text('metadata')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->text('diskon')->nullable();
            $table->integer('total')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->string('status')->comment('1. success, 2. order, 3. failed');
            $table->dateTime('success_at')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('product_type');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
