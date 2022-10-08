<?php

namespace App\Models;

use App\Events\UserEvents\UserCreatedEvent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Ramsey\Uuid\Uuid;

/**
 * @property uuid $id
 * @property string $email
 * @property string $password
 * @property string $status
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'email',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => UserCreatedEvent::class,
    ];

    protected function password(): Attribute
    {
        $set = fn (string $password) =>  app('hash')->make($password);

        return Attribute::make(set: $set);
    }

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'id', 'id');
    }

    /**
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'id');
    }

    /**
     * @return HasMany
     */
    public function departureOwner(): HasMany
    {
        return $this->hasMany(Departure::class, 'head_id', 'id');
    }
}
