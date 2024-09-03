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
        Schema::table('documentation_services', function (Blueprint $table) {
            $table->string('include1');
            $table->string('include2');
            $table->string('section2')->nullable();
            $table->string('description2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentation_services', function (Blueprint $table) {
            $table->dropColumn('include1');
            $table->dropColumn('include2');
            $table->dropColumn('section2');
            $table->dropColumn('description2');
        });
    }
};
