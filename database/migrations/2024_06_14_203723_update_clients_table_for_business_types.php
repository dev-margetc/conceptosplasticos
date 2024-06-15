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
            $table->unsignedBigInteger('business_type_id')->nullable()->after('country_id');
            $table->unsignedBigInteger('customer_type_id')->nullable()->after('business_type_id');

            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('set null');
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('set null');

            $table->dropColumn('business_type');
            $table->dropColumn('customer_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['business_type_id']);
            $table->dropForeign(['customer_type_id']);

            $table->dropColumn('business_type_id');
            $table->dropColumn('customer_type_id');

            $table->string('business_type');
            $table->string('customer_type');
        });
    }
};
