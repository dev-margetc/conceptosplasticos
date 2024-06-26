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
        Schema::create('component_raw_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')->constrained()->onDelete('cascade');
            $table->foreignId('raw_material_id')->constrained()->onDelete('cascade');
            $table->decimal('percentage', 5, 2);
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_raw_material');
    }
};
