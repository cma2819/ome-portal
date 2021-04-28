<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EventPlan extends Model
{
    protected $fillable = [
        'name',
        'status',
        'explanation',
    ];

    protected $casts = [
        'id' => 'integer',
        'planner_id' => 'integer',
        'name' => 'string',
        'status' => 'string',
        'explanation' => 'string',
    ];

    public function planner()
    {
        return $this->belongsTo(User::class, 'planner_id');
    }
}
