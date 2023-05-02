<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AttributeTypeSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(AttributeGroupSeeder::class);
        $this->call(AttributeFamilySeeder::class);
        $this->call(InventorySourceSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
