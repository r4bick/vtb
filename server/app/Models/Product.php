<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $name
 * @property string $description
 * @property string $photo
 * @property integer $price
 * @property string $type
 * @property array $features
 */
class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'photo',
        'price',
        'type',
        'features',
    ];

    protected $casts = [
        'features' => 'array'
    ];
}
