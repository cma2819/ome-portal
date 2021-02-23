<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\AssociateEvent
 *
 * @property string $id
 * @property string $relate_type
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent whereRelateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssociateEvent whereUpdatedAt($value)
 */
	class AssociateEvent extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\AttendeeTask
 *
 * @property int $id
 * @property string $event_id
 * @property string $attendee_scope
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereAttendeeScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTask whereUpdatedAt($value)
 */
	class AttendeeTask extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\AttendeeTaskProgress
 *
 * @property int $id
 * @property int $task_id
 * @property int $event_attendee_id
 * @property string $progress_status
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereEventAttendeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereProgressStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendeeTaskProgress whereUpdatedAt($value)
 */
	class AttendeeTaskProgress extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\DiscordRolePermission
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

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\EventAttendee
 *
 * @property int $id
 * @property string $event_id
 * @property int $user_id
 * @property string $attend_scope
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereAttendScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAttendee whereUserId($value)
 */
	class EventAttendee extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\EventScheme
 *
 * @property int $id
 * @property int $planner_id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property string $explanation
 * @property mixed $detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Infrastructure\Eloquents\EventSchemeReply[] $adminReplies
 * @property-read int|null $admin_replies_count
 * @property-read \App\Infrastructure\Eloquents\User $planner
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme wherePlannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventScheme whereUpdatedAt($value)
 */
	class EventScheme extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\EventSchemeReply
 *
 * @property int $id
 * @property int $scheme_id
 * @property string $to_status
 * @property string $admin_reply
 * @property \Illuminate\Support\Carbon $replied_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Infrastructure\Eloquents\EventScheme $scheme
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereAdminReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereRepliedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereToStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSchemeReply whereUpdatedAt($value)
 */
	class EventSchemeReply extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\TwitchConnection
 *
 * @property int $id
 * @property string $twitch_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Infrastructure\Eloquents\TwitchStream[] $streams
 * @property-read int|null $streams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Infrastructure\Eloquents\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection whereTwitchUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchConnection whereUpdatedAt($value)
 */
	class TwitchConnection extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\TwitchStream
 *
 * @property int $id
 * @property int $twitch_connection_id
 * @property string $stream_id
 * @property string $title
 * @property string $game
 * @property int $viewers
 * @property string $thumbnail_uri
 * @property string $status
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $finished_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Infrastructure\Eloquents\TwitchConnection|null $connection
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereThumbnailUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereTwitchConnectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitchStream whereViewers($value)
 */
	class TwitchStream extends \Eloquent {}
}

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\User
 *
 * @property int $id
 * @property string $name
 * @property string $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Infrastructure\Eloquents\UserDiscord|null $discord
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Infrastructure\Eloquents\TwitchConnection[] $twitch
 * @property-read int|null $twitch_count
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

namespace App\Infrastructure\Eloquents{
/**
 * App\Infrastructure\Eloquents\UserDiscord
 *
 * @property int $id
 * @property string $discord_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Infrastructure\Eloquents\User $user
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

