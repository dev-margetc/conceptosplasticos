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
        Schema::table('component_project', function (Blueprint $table) {
            $table->integer('is_selected')->default(0)->after('component_id')->comment('Indicates if the component is selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('component_project', function (Blueprint $table) {
            $table->dropColumn('is_selected');
        });
    }
};
