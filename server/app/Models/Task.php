<?php

namespace App\Models;

use App\Constants\TaskStatuses;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $name
 * @property string $description
 * @property uuid $author_id
 * @property uuid $validator_id
 * @property date $begin_at
 * @property date $end_at
 * @property integer $participant_number
 * @property string $type
 * @property string $status
 * @property string $category
 * @property integer $reward
 */
class Task extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'author_id',
        'validator_id',
        'expire_at',
        'participant_number',
        'type',
        'status',
        'category',
        'reward',
    ];

    protected $attributes = [
        'status' => TaskStatuses::OPEN,
        'participant_number' => 1,
    ];

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id', 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validator_id', 'id', 'validator_id');
    }

    /**
     * @return MorphTo
     */
    public function participants(): MorphTo
    {
        return $this->morphTo(null, 'type', 'id', 'task_id');
    }
}
