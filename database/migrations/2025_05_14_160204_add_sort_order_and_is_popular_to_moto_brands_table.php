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
        Schema::table('moto_brands', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('status');
            $table->boolean('is_popular')->default(false)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moto_brands', function (Blueprint $table) {
            //
        });
    }
};
