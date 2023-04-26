<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use App\Models\AttributeType;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //Общее
            [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$TEXT,
                'code' => 'sku',
                'label' => 'SKU',
                'default' => true,
                'required' => true,
                'unique' => true,
            ],
            [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$TEXT,
                'code' => 'product_number',
                'label' => 'Номер товара',
                'default' => true,
                'required' => false,
                'unique' => true,
            ],
            [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$TEXT,
                'code' => 'name',
                'label' => 'Наименование',
                'default' => true,
                'required' => true,
                'unique' => false,
            ],
           /* [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$TEXT,
                'code' => 'slug',
                'label' => 'URL наименование',
                'default' => true,
                'required' => true,
                'unique' => false,
            ],*/
            [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$BOOLEAN,
                'code' => 'new',
                'label' => 'Новый',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$COMMON,
                'attribute_type_value_fk' => AttributeType::$BOOLEAN,
                'code' => 'status',
                'label' => 'Статус',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            //Описание
            [
                'group_name_fk' => AttributeGroup::$DESCRIPTION,
                'attribute_type_value_fk' => AttributeType::$TEXTAREA,
                'code' => 'short_description',
                'label' => 'Краткое описание',
                'default' => true,
                'required' => true,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$DESCRIPTION,
                'attribute_type_value_fk' => AttributeType::$TEXTAREA,
                'code' => 'description',
                'label' => 'Подробное описание',
                'default' => true,
                'required' => true,
                'unique' => false,
            ],
            //Цена
            [
                'group_name_fk' => AttributeGroup::$PRICE,
                'attribute_type_value_fk' => AttributeType::$PRICE,
                'code' => 'price',
                'label' => 'Цена продажи',
                'default' => true,
                'required' => true,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$PRICE,
                'attribute_type_value_fk' => AttributeType::$PRICE,
                'code' => 'base_price',
                'label' => 'Цена закупки',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$PRICE,
                'attribute_type_value_fk' => AttributeType::$PRICE,
                'code' => 'special_price',
                'label' => 'Специальная цена',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$PRICE,
                'attribute_type_value_fk' => AttributeType::$DATE,
                'code' => 'special_price_from',
                'label' => 'Специальная цена действительна с',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            [
                'group_name_fk' => AttributeGroup::$PRICE,
                'attribute_type_value_fk' => AttributeType::$DATE,
                'code' => 'special_price_to',
                'label' => 'Специальная цена действительна по',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
            //Доставка
            [
                'group_name_fk' => AttributeGroup::$SHIPPING,
                'attribute_type_value_fk' => AttributeType::$TEXT,
                'code' => 'weight',
                'label' => 'Вес',
                'default' => true,
                'required' => false,
                'unique' => false,
            ],
        ];

        ProductAttribute::insert($data);
    }
}
