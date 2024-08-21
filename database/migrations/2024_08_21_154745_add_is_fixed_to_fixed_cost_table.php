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
        Schema::table('fixed_costs', function (Blueprint $table) {
            $table->integer('is_fixed')
                  ->default(0)
                  ->comment('1 = variable, 0 = fixed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fixed_costs', function (Blueprint $table) {
            $table->dropColumn('is_fixed');
        });
    }
};
