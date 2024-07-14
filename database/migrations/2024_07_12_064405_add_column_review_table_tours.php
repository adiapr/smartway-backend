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
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('review')->default(968);
            $table->string('link_review', 500)->default('https://www.tripadvisor.co.id/Attraction_Review-g297710-d14770546-Reviews-Smartway_Indonesia_Tours-Malang_East_Java_Java.html');
            $table->text('ketentuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('review');
            $table->dropColumn('link_review');
            $table->dropColumn('ketentuan');
        });
    }
};
