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
        Schema::create('attributes_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_group_id');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups');
            $table->primary(['attribute_group_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes_groups');
    }
};
