<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class DiscordRolePermission extends Model
{
    protected $fillable = [
        'discord_role_id', 'allowed_domain'
    ];
}
