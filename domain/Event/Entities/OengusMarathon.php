<?php

namespace Ome\Event\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use Ome\Event\Values\MarathonStatus;

class OengusMarathon
{

    private string $id;

    private string $name;

    private DateTimeInterface $startAt;

    private DateTimeInterface $endAt;

    private bool $submitsOpen;

    private MarathonStatus $status;

    protected function __construct(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        bool $submitsOpen,
        MarathonStatus $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->submitsOpen = $submitsOpen;
        $this->status = $status;
    }

    public static function createRegistered(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        bool $submitsOpen,
        MarathonStatus $status
    ): self {
        return new self(
            $id,
            $name,
            $startAt,
            $endAt,
            $submitsOpen,
            $status
        );
    }

    public static function createFromApiJson(array $json): self
    {
        return new self(
            $json['id'],
            $json['name'],
            Carbon::make($json['startDate']),
            Carbon::make($json['endDate']),
            $json['submitsOpen'],
            MarathonStatus::createFromCondition(
                $json['selectionDone'],
                $json['scheduleDone'],
                (Carbon::make($json['endDate']) < Carbon::now())
            )
        );
    }

    public function isActiveAt(DateTimeInterface $date): bool
    {
        $archivedAt = Carbon::make($this->endAt)->addDay(1)->startOfDay();
        return $archivedAt->isAfter($date);
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
     * Get the value of submitsOpen
     */
    public function getSubmitsOpen()
    {
        return $this->submitsOpen;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
