<?php

namespace Database\Seeders;

use App\Models\AttributeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributeTypes = [
            [
                'label' => 'Текст',
                'value' => AttributeType::$TEXT
            ],
            [
                'label' => 'Текстовая область',
                'value' => AttributeType::$TEXTAREA
            ],
            [
                'label' => 'Стоимость',
                'value' => AttributeType::$PRICE
            ],
            [
                'label' => 'Логический',
                'value' => AttributeType::$BOOLEAN
            ],
            [
                'label' => 'Выпадающий список',
                'value' => AttributeType::$SELECT
            ],
            [
                'label' => 'Множественный выбор',
                'value' => AttributeType::$MULTISELECT
            ],
            [
                'label' => 'Дата и время',
                'value' => AttributeType::$DATETIME
            ],
            [
                'label' => 'Дата',
                'value' => AttributeType::$DATE
            ],
        ];

        AttributeType::insert($attributeTypes);
    }
}
