<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EventScheme extends Model
{
    protected $fillable = [
        'name', 'status', 'start_at', 'end_at', 'explanation', 'detail'
    ];

    protected $casts = [
        'id' => 'integer',
        'planner_id' => 'integer',
        'name' => 'string',
        'status' => 'string',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'explanation' => 'string',
        'detail' => 'string,'
    ];

    public function planner()
    {
        return $this->belongsTo(User::class, 'planner_id');
    }

    public function adminReplies()
    {
        return $this->hasMany(EventSchemeReply::class, 'scheme_id');
    }
}
