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
        Schema::table('franchises', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->string('identification')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('brand_logo')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website_url')->nullable();
            $table->text('description')->nullable()->change();
            $table->string('state')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('franchises', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('country');
            $table->dropColumn('currency');
            $table->dropColumn('identification');
            $table->dropColumn('address');
            $table->dropColumn('zip_code');
            $table->dropColumn('brand_logo');
            $table->dropColumn('contact_phone');
            $table->dropColumn('email');
            $table->dropColumn('website_url');
            $table->string('description')->nullable(false)->change();
            $table->string('state')->nullable(false)->change();
        });
    }
};
