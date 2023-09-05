<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('number');
            $table->integer('status')->default(0);
            $table->integer('payment');
            $table->boolean('shipping');
            $table->json('address')->nullable()->default(null);
            $table->string('details', 5000)->nullable()->default(null);
            $table->foreign('customer_id')->references('id')
                ->on('customers')->nullOnDelete();
            $table->dateTime('confirmed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
