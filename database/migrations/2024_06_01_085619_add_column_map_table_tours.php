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
            $table->integer('duration');
            $table->integer('group_size');
            $table->string('transportation');
            $table->string('free_cancel');
            $table->text('map');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('group_size');
            $table->dropColumn('transportation');
            $table->dropColumn('free_cancel');
            $table->dropColumn('map');
        });
    }
};
