<?php

namespace Ome\Event\Entities;

use Carbon\Carbon;
use DateTimeInterface;

class OengusMarathon
{

    private string $id;

    private string $name;

    private DateTimeInterface $startAt;

    private DateTimeInterface $endAt;

    protected function __construct(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    public static function createRegistered(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt
    ): self {
        return new self(
            $id,
            $name,
            $startAt,
            $endAt
        );
    }

    public static function createFromApiJson(array $json): self
    {
        return new self(
            $json['id'],
            $json['name'],
            Carbon::make($json['startDate']),
            Carbon::make($json['endDate'])
        );
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
}
