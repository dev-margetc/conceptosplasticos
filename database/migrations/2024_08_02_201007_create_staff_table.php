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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->decimal('salary', 10, 2);
            $table->decimal('transport_assistance', 10, 2);
            $table->decimal('overtime_surcharge', 10, 2);
            $table->string('epp'); 
            $table->decimal('health', 10, 2);
            $table->decimal('pension', 10, 2);
            $table->decimal('severance_pay', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
