<?php

namespace App\Constants;

class UserStatuses
{
    use Serializer;

    public const ACTIVE = 'active';
    public const PENDING = 'pending';
    public const BANNED = 'banned';
}
