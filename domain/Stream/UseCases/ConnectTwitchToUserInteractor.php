<?php

namespace Ome\Stream\UseCases;

use Ome\Exceptions\EntityNotFoundException;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Interfaces\Commands\PersistStreamerCommand;
use Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserRequest;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserResponse;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserUseCase;

class ConnectTwitchToUserInteractor implements ConnectTwitchToUserUseCase
{

    protected FindStreamerByIdQuery $findStreamerById;

    protected PersistStreamerCommand $persistStreamer;

    public function __construct(
        FindStreamerByIdQuery $findStreamerById,
        PersistStreamerCommand $persistStreamer
    ) {
        $this->findStreamerById = $findStreamerById;
        $this->persistStreamer = $persistStreamer;
    }

    public function interact(ConnectTwitchToUserRequest $request): ConnectTwitchToUserResponse
    {
        $streamer = $this->findStreamerById->fetch($request->getUserId());
        if (is_null($streamer)) {
            throw new EntityNotFoundException(Streamer::class, ['id' => $request->getUserId()]);
        }

        $streamer->addTwitchUser($request->getTwitchUser());

        return new ConnectTwitchToUserResponse(
            $this->persistStreamer->execute($streamer)
        );
    }
}
