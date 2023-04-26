<?php

namespace Database\Seeders;

use App\Models\InventorySource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventorySource::create([
            'code' => InventorySource::$DEFAULT,
            'name' => 'По умолчанию',
            'status'=> true,
            'contact_information' => [],
            'address' => []
        ]);
    }
}
