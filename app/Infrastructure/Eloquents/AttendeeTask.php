<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class AttendeeTask extends Model
{
    protected $fillable = [
        'attendee_scope', 'content', 'event_id',
    ];
}
