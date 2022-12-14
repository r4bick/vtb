<?php

namespace App\Models;

use App\Constants\TaskStatuses;
use App\Events\TaskEvents\TaskCreatingEvent;
use App\Events\TaskEvents\TaskUpdatedToCompletedStageEvent;
use App\Services\EventService\HasCustomModelEvents;
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
 * @property integer $like_number
 * @property integer $dislike_number
 */
class Task extends Model
{
    use HasCustomModelEvents, HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'author_id',
        'validator_id',
        'begin_at',
        'end_at',
        'participant_number',
        'type',
        'status',
        'category',
        'reward',
        'like_number',
        'dislike_number',
    ];

    protected $attributes = [
        'status' => TaskStatuses::OPEN,
        'participant_number' => 1,
        'like_number' => 0,
        'dislike_number' => 0,
    ];

    protected $dispatchesEvents = [
        'creating' => TaskCreatingEvent::class,
        'updated: status={*,completed}' => TaskUpdatedToCompletedStageEvent::class,
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
