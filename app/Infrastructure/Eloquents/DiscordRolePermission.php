<?php

namespace App\Infrastructure\Eloquents;

use Illuminate\Database\Eloquent\Model;

class DiscordRolePermission extends Model
{
    protected $fillable = [
        'discord_role_id', 'allowed_domain'
    ];
}
