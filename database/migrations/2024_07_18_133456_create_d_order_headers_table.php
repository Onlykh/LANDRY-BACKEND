<?php

use App\Enums\OrderStateEnum;
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
        Schema::create('d_order_headers', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('state')->default(OrderStateEnum::IN_PROGRESS());
            $table->foreignId('client_id')->constrained(
                'd_users',
                'id'
            );
            $table->string('ref_service');
            $table->foreign('ref_service')->references('reference')->on('p_services');
            $table->unsignedBigInteger('phone_number');

            $table->dateTime('order_date');
            $table->dateTime('pick_up_date')->nullable();
            $table->dateTime('delivery_date');

            $table->json('pick_up_address');
            $table->json('delivery_address');

            $table->decimal('total_ht', 24, 6)->default(0);
            $table->decimal('total_tva', 24, 6)->default(0);
            $table->decimal('total_ttc', 24, 6)->default(0);
            $table->decimal('total_discount', 24, 6)->default(0);
            $table->decimal('delivery_cost', 24, 6)->default(0);
            $table->decimal('net_to_pay', 24, 6)->default(0);

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_order_headers');
    }
};
