<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $name
 * @property array $condition
 */
class Grade extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'condition',
    ];

    protected $casts = [
        'condition' => 'array'
    ];
}
