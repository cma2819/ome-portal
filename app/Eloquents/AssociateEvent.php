<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class AssociateEvent extends Model
{
    protected $fillable = [
        'id', 'relate_type', 'slug'
    ];

    protected $keyType = 'string';
}
