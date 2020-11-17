<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class AttendeeTaskProgress extends Model
{
    protected $fillable = [
        'event_attendee_id', 'note', 'progress_status', 'task_id',
    ];
}
