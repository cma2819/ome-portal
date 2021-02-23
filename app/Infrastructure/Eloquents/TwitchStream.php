<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class TwitchStream extends Model
{
    protected $fillable = [
        'stream_id',
        'title',
        'game',
        'viewers',
        'thumbnail_uri',
        'status',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function connection()
    {
        return $this->hasOne(TwitchConnection::class);
    }
}
