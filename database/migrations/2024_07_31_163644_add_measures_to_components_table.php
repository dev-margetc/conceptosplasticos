<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DB::table('components')->whereNull('quantity')->update(['quantity' => 0]);

        Schema::table('components', function (Blueprint $table) {
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('broad', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('value_kilo', 10, 2)->nullable();
            $table->integer('quantity')->nullable()->default(0)->change();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('components', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->default(null)->change();
            $table->dropColumn(['length', 'broad', 'height', 'value_kilo']);
        });
    }
};
