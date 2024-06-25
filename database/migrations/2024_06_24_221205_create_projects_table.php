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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('name');
            $table->string('status')->default('0');
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('project_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('project_name')->nullable();
        });

        Schema::dropIfExists('projects');
    }
};
