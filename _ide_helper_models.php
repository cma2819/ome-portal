<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Eloquents{
/**
 * App\Eloquents\DiscordRolePermission
 *
 * @property int $id
 * @property string $discord_role_id
 * @property string $allowed_domain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission whereAllowedDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission whereDiscordRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscordRolePermission whereUpdatedAt($value)
 */
	class DiscordRolePermission extends \Eloquent {}
}

namespace App\Eloquents{
/**
 * App\Eloquents\User
 *
 * @property int $id
 * @property string $name
 * @property string $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Eloquents\UserDiscord|null $discord
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Eloquents{
/**
 * App\Eloquents\UserDiscord
 *
 * @property int $id
 * @property string $discord_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Eloquents\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord whereDiscordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDiscord whereUserId($value)
 */
	class UserDiscord extends \Eloquent {}
}

