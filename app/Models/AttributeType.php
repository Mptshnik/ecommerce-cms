<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    use HasFactory;

    public static string $TEXT = 'text';
    public static string $TEXTAREA = 'textarea';
    public static string $PRICE = 'price';
    public static string $BOOLEAN = 'boolean';
    public static string $SELECT = 'select';
    public static string $MULTISELECT = 'multiselect';
    public static string $DATETIME = 'datetime';
    public static string $DATE = 'date';
    public static string $IMAGE = 'image';
    public static string $FILE = 'file';
    public static string $CHECKBOX = 'checkbox';

    protected $guarded = false;
}
