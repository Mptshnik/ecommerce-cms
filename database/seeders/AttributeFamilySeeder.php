<?php

namespace Database\Seeders;

use App\Models\AttributeFamily;
use App\Models\AttributeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AttributeFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $family = AttributeFamily::create([
            'code' => 'default',
            'name' => 'По умолчанию'
        ]);

        $groups = AttributeGroup::all()->pluck('name');

        $family->groups()->sync($groups);
    }
}
