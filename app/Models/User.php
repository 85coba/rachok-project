<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Prophecy\Exception\InvalidArgumentException;
use App\Contracts\Remover;
use App\Contracts\Processor;
use App\Traits\CanRemove;
use App\Traits\CanProcess;
use App\Models\UserSettings;

class User extends Authenticatable implements JWTSubject, Remover, Processor
{
    use Notifiable, CanRemove, CanProcess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() 
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function changeFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException('User firs name cannot be empty.');
        }

        $this->attributes['first_name'] = $firstName;
    }

    public function changeLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException('User last name cannot be empty.');
        }

        $this->attributes['last_name'] = $lastName;
    }

    public function changeNickName(string $nickname): void
    {
        if (empty($nickname)) {
            throw new InvalidArgumentException('User nickname cannot be empty.');
        }

        $this->attributes['nick_name'] = $nickname;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getNickName(): string
    {
        return $this->nickname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function settings()
    {
        return $this->hasMany(UserSettings::class);
    }
}
