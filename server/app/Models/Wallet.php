<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $public_key
 * @property string $private_key
 * @property string $type
 */
class Wallet extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $hidden = [
        'private_key',
    ];

    /**
     * @return MorphTo
     */
    public function owner(): MorphTo
    {
        return $this->morphTo(null, 'type', 'id', 'id');
    }
}
