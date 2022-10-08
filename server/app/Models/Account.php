<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $first_name
 * @property string $last_name
 * @property string $family_name
 * @property uuid $departure_id
 * @property string $level
 */
class Account extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'family_name',
        'departure_id',
        'level',
    ];

    protected $attributes = [
        'level' => '0',
    ];
}
