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
        $common = AttributeGroup::create([
            'name' => AttributeGroup::$COMMON,
        ]);
        $common->attributes()->sync([1,2,3,4,5]);

        $description = AttributeGroup::create([
            'name' => AttributeGroup::$DESCRIPTION,
        ]);
        $description->attributes()->sync([6,7]);

        $price = AttributeGroup::create([
            'name' => AttributeGroup::$PRICE,
        ]);
        $price->attributes()->sync([8,9,10,11,12]);

        $shipping = AttributeGroup::create([
            'name' => AttributeGroup::$SHIPPING,
        ]);
        $shipping->attributes()->sync([13]);
    }
}
