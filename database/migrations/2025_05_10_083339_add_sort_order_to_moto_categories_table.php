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
        Schema::table('moto_categories', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('status')->comment('Sort order for the category in the list');
            $table->boolean('is_show')->default(true)->after('sort_order')->comment('Show in category list');
            $table->boolean('is_popular')->default(false)->after('sort_order')->nullable()->comment('Popular category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moto_categories', function (Blueprint $table) {
            //
        });
    }
};
