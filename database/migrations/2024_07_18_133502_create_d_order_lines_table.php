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
        Schema::create('d_order_lines', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->foreignId('d_order_header_id')->constrained();

            $table->string('ref_article');
            $table->foreign('ref_article')->references('reference')->on('p_articles');

            $table->decimal('qte', 24, 6);
            $table->decimal('unit_price_ht', 24, 6);
            $table->decimal('amount_ht', 24, 6);

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_order_lines');
    }
};
