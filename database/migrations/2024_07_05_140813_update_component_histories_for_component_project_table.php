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
        Schema::table('component_histories', function (Blueprint $table) {
            $table->dropForeign(['component_id']);
            $table->dropColumn('component_id');

            $table->unsignedBigInteger('component_project_id')->after('id');
            $table->foreign('component_project_id')->references('id')->on('component_project')->onDelete('cascade');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn('project_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('component_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('component_id')->after('component_project_id');
            $table->dropForeign(['component_project_id']);
            $table->dropColumn('component_project_id');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->after('group_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }
};
