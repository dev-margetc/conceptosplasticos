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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['project_status_id']);
            $table->dropColumn('project_status_id');
            $table->dropColumn('comment');
        });

        Schema::create('client_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_status_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comments');
            $table->timestamps();
            $table->engine = 'InnoDB';

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('project_status_id')->references('id')->on('project_statuses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_histories');

        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('project_status_id')->nullable();
            $table->foreign('project_status_id')->references('id')->on('project_statuses')->onDelete('cascade');
            $table->text('comment')->nullable();
        });
    }
};
