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
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spec_category_id')->constrained()->onDelete('cascade');
            $table->string('name');   // Internal key, e.g. 'cc'
            $table->string('label');  // Display label, e.g. 'Engine Capacity (cc)'
            $table->string('type');   // Enum value, e.g. 'integer', from SpecAttributeType
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specs');
    }
};
