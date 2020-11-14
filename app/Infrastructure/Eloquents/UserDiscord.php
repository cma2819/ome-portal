<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class UserDiscord extends Model
{
    protected $fillable = [
        'discord_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
