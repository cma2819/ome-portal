<?php

namespace App\Domain\Event\Queries;

use App\Api\Oengus\OengusApiClient;
use DateTimeInterface;
use Ome\Event\Entities\OengusMarathon as OengusMarathonEntity;
use Ome\Event\Interfaces\Queries\OengusMarathonQuery;

class OengusMarathon implements OengusMarathonQuery
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
