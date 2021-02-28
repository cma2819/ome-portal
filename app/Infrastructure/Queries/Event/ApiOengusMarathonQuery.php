<?php

namespace App\Infrastructure\Queries\Event;

use App\Api\Oengus\OengusApiClient;
use App\Api\Oengus\OengusHttpException;
use App\Facades\Logger;
use DateTimeInterface;
use Illuminate\Support\Facades\Log;
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

    public function fetch(string $id, DateTimeInterface $now): ?OengusMarathonEntity
    {
        $endpoint = "/marathon/${id}";
        try {
            $apiJson = $this->oengusApiClient->apiGet($endpoint);
        } catch (OengusHttpException $e) {
            Logger::warning('string', 'Event.Query', $e->getMessage());
            return null;
        }

        return OengusMarathonEntity::createFromApiJson($apiJson, $now);
    }
}
