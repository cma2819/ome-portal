<?php

namespace Ome\Stream\UseCases;

use Ome\Exceptions\EntityNotFoundException;
use Ome\Stream\Entities\Streamer;
use Ome\Stream\Interfaces\Queries\FindStreamerByIdQuery;
use Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdRequest;
use Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdResponse;
use Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdUseCase;

class GetStreamerByUserIdInteractor implements GetStreamerByUserIdUseCase
{

    protected FindStreamerByIdQuery $findStreamerById;

    public function __construct(
        FindStreamerByIdQuery $findStreamerById
    ) {
        $this->findStreamerById = $findStreamerById;
    }

    public function interact(GetStreamerByUserIdRequest $request): GetStreamerByUserIdResponse
    {
        $streamer = $this->findStreamerById->fetch($request->getUserId());

        if (is_null($streamer)) {
            throw new EntityNotFoundException(Streamer::class, ['id' => $request->getUserId()]);
        }

        return new GetStreamerByUserIdResponse($streamer);
    }
}
