<?php

namespace App\Infrastructure\Commands\Notification;

use App\Api\Discord\DiscordApiClient;
use Ome\Notification\Entities\Notifiable;
use Ome\Notification\Interfaces\Commands\SendNotificationCommand;

class DiscordSendNotificationCommand implements SendNotificationCommand
{
    protected DiscordApiClient $discordApi;

    public function __construct(
        DiscordApiClient $discordApi
    ) {
        $this->discordApi = $discordApi;
    }

    public function execute(Notifiable $notification)
    {
        $channelId = config('services.discord.notify_channel_id');
        $endpoint = 'channels/' . $channelId . '/messages';

        $this->discordApi->apiPost($endpoint, [
            'content' =>
            "** {$notification->getSubject()} **" . PHP_EOL .
            PHP_EOL .
            "{$notification->getMessage()}",
        ]);
    }
}
