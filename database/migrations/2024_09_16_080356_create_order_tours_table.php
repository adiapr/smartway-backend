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
        Schema::create('order_tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('tour_id');
            $table->integer('jml_peserta');
            $table->tinyInteger('status')->default(0)->comment('0 : belum, 1 : acc');
            $table->date('keberangkatan');
            $table->string('name', 1000);
            $table->string('pasport', 1000)->nullable();
            $table->string('birthday', 1000)->nullable();
            $table->string('phone', 1000)->nullable();
            $table->string('instagram', 1000)->nullable();
            $table->string('tiktok', 1000)->nullable();
            $table->string('email', 1000)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tours');
    }
};
