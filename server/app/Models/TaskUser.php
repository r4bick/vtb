<?php

namespace App\Models;

use App\Events\TaskEvents\TaskUserCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Ramsey\Uuid\Uuid;

/**
 * @property int $id
 * @property uuid $task_id
 * @property uuid $user_id
 */
class TaskUser extends Model
{
    use HasFactory;

    protected $table = 'task_user';

    /**
     * @var string[]
     */
    protected $fillable = [
        'task_id',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'created' => TaskUserCreatedEvent::class,
    ];

    /**
     * @return MorphMany
     */
    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'participants');
    }

    /**
     * @return BelongsTo
     */
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }
}
