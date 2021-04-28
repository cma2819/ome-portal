<?php

namespace App\Http\Responses\Api\Plans;

use App\Http\Responses\Api\Auth\UserProfileResponse;
use JsonSerializable;
use Ome\Event\Values\PlanStatus;

class PlanResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        int $id,
        string $name,
        UserProfileResponse $planner,
        PlanStatus $status,
        string $explanation
    ) {
        $this->json = [
            'id' => $id,
            'name' => $name,
            'planner' => $planner->jsonSerialize(),
            'status' => $status->value(),
            'explanation' => $explanation,
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}
