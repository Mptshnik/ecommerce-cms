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
        Schema::create('attributes_families', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_family_id');

            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->cascadeOnDelete();
            $table->foreign('attribute_family_id')->references('id')
                ->on('attribute_families')->cascadeOnDelete();

            $table->primary(['attribute_id', 'attribute_family_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes_families');
    }
};
