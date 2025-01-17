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
        Schema::create('p_services', function (Blueprint $table) {
            $table->string('reference')->unique()->primary();
            $table->string('entitled');
            $table->text('description');
            $table->tinyInteger('type');
            $table->tinyInteger('state');
            $table->string('color');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_services');
    }
};
