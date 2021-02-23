<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class TwitchConnection extends Model
{
    protected $fillable = [
        'twitch_user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_twitch_connection');
    }

    public function streams()
    {
        return $this->hasMany(TwitchStream::class);
    }
}
