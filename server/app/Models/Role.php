<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $role_id
 * @property uuid $user_id
 */
class Role extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'role_id',
        'user_id',
    ];
}
