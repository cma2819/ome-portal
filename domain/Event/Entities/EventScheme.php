<?php

namespace Ome\Event\Entities;

use DateTimeInterface;

class EventScheme
{
    private ?int $id;

    private string $name;

    private int $plannerId;

    private ?DateTimeInterface $startAt;

    private ?DateTimeInterface $endAt;

    private string $explanation;

    private string $detail;

    protected function __construct(
        ?int $id,
        string $name,
        int $plannerId,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation,
        string $detail
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->plannerId = $plannerId;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->explanation = $explanation;
        $this->detail = $detail;
    }

    public static function createNewScheme(
        string $name,
        int $plannerId,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation,
        string $detail
    ): self {
        return new self(
            null,
            $name,
            $plannerId,
            $startAt,
            $endAt,
            $explanation,
            $detail
        );
    }

    public static function createRegistered(
        int $id,
        string $name,
        int $plannerId,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation,
        string $detail
    ): self {
        return new self(
            $id,
            $name,
            $plannerId,
            $startAt,
            $endAt,
            $explanation,
            $detail
        );
    }
}
