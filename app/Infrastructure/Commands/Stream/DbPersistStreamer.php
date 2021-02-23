<?php

namespace App\Infrastructure\Commands\Stream;

use App\Infrastructure\Eloquents\TwitchConnection;
use App\Infrastructure\Eloquents\TwitchStream as TwitchStreamEloquent;
use App\Infrastructure\Eloquents\User as UserEloquent;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Entities\Twitch;
use Ome\Stream\Entities\TwitchUser;
use Ome\Stream\Interfaces\Commands\PersistStreamerCommand;

class DbPersistStreamer implements PersistStreamerCommand
{
    public function execute(Streamer $streamer): Streamer
    {
        DB::beginTransaction();

        try {
            /** @var string[] */
            $streamerTwitchId = collect($streamer->getTwitch())->map(function (TwitchUser $twitch) {
                return $twitch->getId();
            })->all();

            /** @var UserEloquent */
            $user = UserEloquent::with('twitch.streams')
                ->where('id', '=', $streamer->getId())
                ->firstOrFail([
                    'id',
                ]);

            $deleteTwitch = $user->twitch->whereNotIn('twitch_user_id', $streamerTwitchId);
            TwitchConnection::query()
                ->whereIn('id', $deleteTwitch->pluck('id'))
                ->delete();

            $userTwitchId = $user->twitch->pluck('twitch_user_id')->all();
            $newTwitch = collect($streamer->getTwitch())->filter(function (TwitchUser $twitch) use ($userTwitchId) {
                return !in_array($twitch->getId(), $userTwitchId);
            });
            $user->twitch()->saveMany($newTwitch->map(function (TwitchUser $twitch) {
                return new TwitchConnection([
                    'twitch_user_id' => $twitch->getId(),
                ]);
            }));

            foreach ($streamer->getStreams() as $stream) {
                if ($stream instanceof Twitch) {
                    /** @var TwitchConnection|null */
                    $twitch = $user->twitch->where('twitch_user_id', '=', $stream->getUserId())->first();
                    if (is_null($twitch)) {
                        throw new ModelNotFoundException("Twitch user connection id = {$stream->getUserId()} not found.");
                    }

                    /** @var TwitchStreamEloquent|null */
                    $exists = $twitch->streams->where('stream_id', '=', $stream->getId())->first();
                    if (is_null($exists)) {
                        $streamEloquent = new TwitchStreamEloquent([
                            'stream_id' => $stream->getId(),
                            'title' => $stream->getTitle(),
                            'game' => $stream->getGame(),
                            'viewers' => $stream->getViewers(),
                            'thumbnail_uri' => $stream->getThumbnail(),
                            'status' => $stream->getStatus()->value(),
                            'started_at' => $stream->getStartedAt(),
                            'finished_at' => $stream->getFinishedAt(),
                        ]);
                        $twitch->streams()->save($streamEloquent);
                    }
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $streamer;
    }
}
