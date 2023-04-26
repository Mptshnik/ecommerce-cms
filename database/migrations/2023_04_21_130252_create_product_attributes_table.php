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
            $table->string('group_name_fk')->nullable()->default(null);
            $table->string('attribute_type_value_fk');
            $table->string('code');
            $table->string('label');
            $table->boolean('default')->default(false);
            $table->json('options')->nullable()->default(null);
            $table->foreign('group_name_fk')->references('name')->on('attribute_groups')->nullOnDelete();
            $table->foreign('attribute_type_value_fk')->references('value')->on('attribute_types')
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
