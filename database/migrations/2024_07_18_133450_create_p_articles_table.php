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
        Schema::create('p_articles', function (Blueprint $table) {
            $table->string('reference')->unique()->primary();
            $table->string('entitled');
            $table->text('description')->nullable();
            $table->unsignedInteger('category');
            $table->foreign('category')->references('category')->on('p_categories');
            $table->unsignedInteger('unit');
            $table->foreign('unit')->references('unit')->on('p_units');
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_articles');
    }
};
