<?php

namespace Ome\Event\UseCases;

use Ome\Event\Interfaces\Queries\OengusMarathonQuery;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusRequest;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusResponse;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusUseCase;

class GetMarathonFromOengusInteractor implements GetMarathonFromOengusUseCase
{

    protected OengusMarathonQuery $oengusMarathonQuery;

    public function __construct(
        OengusMarathonQuery $oengusMarathonQuery
    ) {
        $this->oengusMarathonQuery = $oengusMarathonQuery;
    }

    public function interact(GetMarathonFromOengusRequest $request): GetMarathonFromOengusResponse
    {
        return new GetMarathonFromOengusResponse($this->oengusMarathonQuery->fetch($request->getId(), $request->getNow()));
    }
}
