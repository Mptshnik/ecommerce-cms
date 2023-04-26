<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => AttributeGroup::$COMMON
            ],
            [
                'name' => AttributeGroup::$DESCRIPTION
            ],
            [
                'name' => AttributeGroup::$PRICE
            ],
            [
                'name' => AttributeGroup::$SHIPPING
            ],
        ];

        AttributeGroup::insert($groups);
    }
}
