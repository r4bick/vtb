<?php

namespace App\Models;

use App\Constants\OrderTypes;
use App\Events\OrderEvents\OrderCreatingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property uuid $product_id
 * @property uuid $user_id
 * @property string $status
 * @property integer $price
 */
class Order extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'status',
        'price',
    ];

    /**
     * @var string[]
     */
    protected $attributes = [
        'status' => OrderTypes::DELIVERED,
    ];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'creating' => OrderCreatingEvent::class
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
