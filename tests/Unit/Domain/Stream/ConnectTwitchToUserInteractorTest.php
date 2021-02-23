<?php

namespace Tests\Unit\Domain\Stream;

use Ome\Stream\Commands\InmemoryPersistStreamer;
use Ome\Stream\Entities\PartialTwitchUser;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserRequest;
use Ome\Stream\Queries\InmemoryFindStreamerById;
use Ome\Stream\UseCases\ConnectTwitchToUserInteractor;
use PHPUnit\Framework\TestCase;

class ConnectTwitchToUserInteractorTest extends TestCase
{
    /** @test */
    public function testConnectTwitchToUser()
    {
        $streamers = [
            Streamer::createRegisteredStreamer(
                1,
                [],
                []
            )
        ];

        $findStreamerById = new InmemoryFindStreamerById($streamers);
        $persistStreamer = new InmemoryPersistStreamer($streamers);

        $interactor = new ConnectTwitchToUserInteractor(
            $findStreamerById,
            $persistStreamer
        );

        $twitch = PartialTwitchUser::createPartial('123456789', 'twitch_user', 'TwitchMan');
        $result = $interactor->interact(
            new ConnectTwitchToUserRequest(
                1,
                $twitch
            )
        );

        $this->assertEquals(
            Streamer::createRegisteredStreamer(
                1,
                [$twitch],
                []
            ), $result->getStreamer()
        );
    }
}
