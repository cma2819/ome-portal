<?php

namespace App\Http\Responses\Api\Schemes;

use App\Http\Responses\Api\Auth\DiscordProfileResponse;
use App\Http\Responses\Api\Auth\UserProfileResponse;
use Carbon\Carbon;
use DateTimeInterface;
use JsonSerializable;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Event\Entities\EventScheme;

class SchemeResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        UserProfile $userProfile,
        EventScheme $scheme
    ) {
        $this->json = [
            'id' => $scheme->getId(),
            'name' => $scheme->getName(),
            'planner' => (new UserProfileResponse(
                $userProfile->getId(),
                $userProfile->getName(),
                new DiscordProfileResponse(
                    $userProfile->getDiscord()->getId(),
                    $userProfile->getDiscord()->getUsername(),
                    $userProfile->getDiscord()->getDiscriminator()
                )
            ))->jsonSerialize(),
            'status' => $scheme->getStatus()->value(),
            'startAt' => $scheme->getStartAt(),
            'endAt' => $scheme->getEndAt(),
            'explanation' => $scheme->getExplanation(),
            'detail' => $scheme->getDetail(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}
