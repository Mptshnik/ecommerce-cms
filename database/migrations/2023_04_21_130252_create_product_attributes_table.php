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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable()->default(null);
            $table->unsignedBigInteger('attribute_type_id');
            $table->string('code');
            $table->string('label');
            $table->json('options')->nullable()->default(null);
            $table->foreign('group_id')->references('id')->on('attribute_groups')->nullOnDelete();
            $table->foreign('attribute_type_id')->references('id')->on('attribute_types')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
