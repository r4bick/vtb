<?php

namespace App\Models;

use App\Events\DepartureEvents\DepartureCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $name
 * @property uuid $head_id
 * @property string $departure_id
 */
class Departure extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'head_id',
        'departure_id',
    ];

    protected $dispatchesEvents = [
        'created' => DepartureCreatedEvent::class,
    ];

    /**
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'id', 'id');
    }
}
