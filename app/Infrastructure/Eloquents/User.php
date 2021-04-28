<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiToken;
    use Notifiable;

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
}
