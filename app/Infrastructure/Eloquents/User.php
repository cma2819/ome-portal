<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;

class User extends Authenticatable implements AuthenticatableInterface
{
    use HasApiToken;
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','api_token'
    ];

    public function discord()
    {
        return $this->hasOne(UserDiscord::class);
    }

    public function twitch()
    {
        return $this->belongsToMany(TwitchConnection::class, 'user_twitch_connection');
    }

    public function canAccessToAdmin(): bool
    {
        return $this->can('access-to-admin');
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
