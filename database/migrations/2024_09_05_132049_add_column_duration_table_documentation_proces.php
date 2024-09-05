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
        Schema::table('dcumentation_prices', function (Blueprint $table) {
            $table->integer('duration');
            $table->integer('edited');
            $table->integer('downloadable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dcumentation_prices', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('edited');
            $table->dropColumn('downloadable');
        });
    }
};
