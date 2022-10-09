<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property uuid $grade_id
 * @property uuid $user_id
 * @property array $progress
 * @property string $status
 * @property date $end_at
 */
class GradeUser extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $table = 'grade_user';

    /**
     * @var string[]
     */
    protected $fillable = [
        'grade_id',
        'user_id',
        'progress',
        'status',
        'end_at',
    ];

    protected $casts = [
        'progress' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
