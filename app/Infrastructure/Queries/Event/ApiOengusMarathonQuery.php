<?php

namespace App\Infrastructure\Queries\Event;

use App\Api\Oengus\OengusApiClient;
use DateTimeInterface;
use Ome\Event\Entities\OengusMarathon as OengusMarathonEntity;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;

class ApiOengusMarathonQuery implements OengusMarathonQuery
{
    protected OengusApiClient $oengusApiClient;

    public function __construct(
        OengusApiClient $oengusApiClient
    ) {
        $this->oengusApiClient = $oengusApiClient;
    }

    public function fetch(string $id, DateTimeInterface $now): OengusMarathonEntity
    {
        $endpoint = "/marathon/${id}";
        $apiJson = $this->oengusApiClient->apiGet($endpoint);

        return OengusMarathonEntity::createFromApiJson($apiJson, $now);
    }
}
