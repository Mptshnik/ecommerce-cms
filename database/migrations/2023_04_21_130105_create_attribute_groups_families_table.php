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
        Schema::create('attribute_groups_families', function (Blueprint $table) {
            $table->string('attribute_group_name_fk');
            $table->unsignedBigInteger('attribute_family_id');
            $table->foreign('attribute_group_name_fk')->references('name')
                ->on('attribute_groups')->cascadeOnDelete();
            $table->foreign('attribute_family_id')->references('id')
                ->on('attribute_families')->cascadeOnDelete();
            $table->primary(['attribute_group_name_fk', 'attribute_family_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_groups_families');
    }
};
