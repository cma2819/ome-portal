<?php

namespace Ome\Event\Interfaces\UseCases\ApplyEventScheme;

use DateTimeInterface;

/**
 * Request object for ApplyEventScheme.
 */
class ApplyEventSchemeRequest
{
    private int $userId;

    private string $name;

    private ?DateTimeInterface $startAt;

    private ?DateTimeInterface $endAt;

    private string $explanation;

    public function __construct(
        int $userId,
        string $name,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation
    ) {
        $this->userId = $userId;
        $this->name = $name;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->explanation = $explanation;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of startAt
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Get the value of endAt
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Get the value of explanation
     */
    public function getExplanation()
    {
        return $this->explanation;
    }
}
