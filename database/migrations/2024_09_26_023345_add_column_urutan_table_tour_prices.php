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
        Schema::table('tour_prices', function (Blueprint $table) {
            $table->integer('urutan');
            $table->integer('pax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_prices', function (Blueprint $table) {
            $table->dropColumn('urutan');
            $table->dropColumn('pax');
        });
    }
};
