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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('bensin');
            $table->text('include');
            $table->text('no_include');
            $table->text('ketentuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('bensin');
            $table->dropColumn('include');
            $table->dropColumn('no_include');
            $table->dropColumn('keterangan');
        });
    }
};
