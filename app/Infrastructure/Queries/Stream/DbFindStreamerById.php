<?php

namespace App\Infrastructure\Queries\Stream;

use App\Api\Twitch\TwitchApiClient;
use App\Facades\Logger;
use App\Infrastructure\Eloquents\TwitchConnection as TwitchConnectionEloquent;
use App\Infrastructure\Eloquents\TwitchStream as TwitchStreamEloquent;
use App\Infrastructure\Eloquents\User as UserEloquent;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Entities\Twitch;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery;

class DbFindStreamerById implements FindStreamerByIdQuery
{
    protected TwitchApiClient $twitchApi;

    public function __construct(
        TwitchApiClient $twitchApi
    ) {
        $this->twitchApi = $twitchApi;
    }

    public function fetch(int $id): ?Streamer
    {
        /** @var UserEloquent|null */
        $userEloquent = UserEloquent::with(['twitch','twitch.streams'])
            ->find($id, ['users.id']);

        if (is_null($userEloquent)) {
            return null;
        }

        /** @var TwitchUser[] */
        $twitch = [];

        $streams = [];

        // Twitch
        if (!$userEloquent->twitch->isEmpty()) {

            $twitchIds = $userEloquent->twitch->map(function (TwitchConnectionEloquent $connection) {
                return $connection->twitch_user_id;
            });

            $idQuery = $twitchIds->map(function (string $id) {
                return 'id=' . $id;
            })->join('&');
            $twitchUserJson = $this->twitchApi->apiGet('/users?' . $idQuery);
            Logger::debug('string', 'Stream.Queries', 'Twitch users from ' . $userEloquent->id);
            Logger::debug('json', 'Stream.Queries', json_encode($twitchUserJson));

            foreach ($twitchUserJson['data'] as $json) {
                $twitchUser = TwitchUser::createFromJson($json);
                $twitch[$twitchUser->getId()] = $twitchUser;
            }

            // Twitch streams
            foreach ($userEloquent->twitch as $connection) {
                /** @var Builder */
                $query = $connection->streams();
                /** @var TwitchStreamEloquent */
                $stream = $query->orderByDesc('stream_id')->first([
                    'id',
                    'status',
                    'twitch_connection_id',
                ]);
                if (!is_null($stream) && array_key_exists($stream->connection->twitch_user_id, $twitch)) {

                    $user = $twitch[$stream->connection->twitch_user_id];

                    if (Twitch::isLiveFromStatus($stream->status)) {
                        $streams[] = Twitch::createLiveRegistered(
                            $stream->id,
                            $connection->twitch_user_id,
                            $stream->game,
                            $stream->title,
                            $user->getUsername(),
                            $stream->viewers,
                            $stream->thumbnail_uri,
                            $stream->started_at
                        );
                    } else {
                        $streams[] = Twitch::createOfflineRegistered(
                            $stream->id,
                            $connection->twitch_user_id,
                            $stream->game,
                            $stream->title,
                            $stream->started_at,
                            $stream->finished_at
                        );
                    }
                }
            }
        }

        return Streamer::createRegisteredStreamer(
            $userEloquent->id,
            $twitch,
            $streams
        );
    }
}
