<?php

namespace Modules\User\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Modules\Message\Entities\Chat;
use Modules\User\Database\factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int id
 * @property string email
 * @property string full_name
 * @property string password
 * @property string|null phone
 * @property string username
 * @property bool is_blocked
 * @property Role roles
 * @property Permission permissions
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 * @property Carbon|null last_login
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $guard_name = 'api';
    protected $dates = ['last_login'];
    protected $fillable = ['full_name', 'email', 'username', 'phone', 'password'];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }


    public function senders(): MorphMany
    {
        return $this->morphMany(Chat::class,'sender');
    }

    public function recipients(): MorphMany
    {
        return $this->morphMany(Chat::class,'recipient');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

}
