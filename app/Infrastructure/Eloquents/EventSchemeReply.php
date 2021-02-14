<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EventSchemeReply extends Model
{
    protected $fillable = ['to_status', 'admin_reply', 'replied_at'];

    protected $casts = [
        'id' => 'integer',
        'scheme_id' => 'integer',
        'to_status' => 'string',
        'admin_reply' => 'string',
        'replied_at' => 'datetime',
    ];

    public function scheme()
    {
        return $this->belongsTo(EventScheme::class, 'scheme_id');
    }
}
