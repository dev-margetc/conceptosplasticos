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
        Schema::table('raw_materials', function (Blueprint $table) {
            // Drop columns that are no longer needed
            $table->dropForeign(['client_id']);
            $table->dropColumn(['length', 'broad', 'height', 'client_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raw_materials', function (Blueprint $table) {
            // Add columns back if the migration is rolled back
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('broad', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
