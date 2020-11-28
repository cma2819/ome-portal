<?php

namespace Ome\Event\Interfaces\UseCases\EditEventScheme;

use DateTimeInterface;

/**
 * Request object for EditEventScheme.
 */
class EditEventSchemeRequest
{
    private int $id;

    private string $name;

    private DateTimeInterface $startAt;

    private DateTimeInterface $endAt;

    private string $explanation;

    public function __construct(
        int $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        string $explanation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->explanation = $explanation;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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
