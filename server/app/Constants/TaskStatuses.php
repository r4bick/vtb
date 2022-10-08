<?php

namespace App\Constants;

class TaskStatuses
{
    use Serializer;

    public const OPEN = 'open';
    public const IN_PROCESSED = 'in_processed';
    public const DONE = 'done';
    public const COMPLETED = 'completed';
    public const REJECTED = 'rejected';
}
