<?php

namespace App\Models;

use App\Events\TaskEvents\TaskDepartureCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Ramsey\Uuid\Uuid;

/**
 * @property int $id
 * @property uuid $departure_id
 * @property uuid $task_id
 */
class TaskDeparture extends Model
{
    use HasFactory;

    protected $table = 'task_departure';

    /**
     * @var string[]
     */
    protected $fillable = [
        'departure_id',
        'task_id',
    ];

    protected $dispatchesEvents = [
        'created' => TaskDepartureCreatedEvent::class,
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
        return $this->belongsTo(Departure::class, 'departure_id', 'id');
    }
}
