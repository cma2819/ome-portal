<?php

namespace Ome\Event\Interfaces\Queries;

use DateTimeInterface;
use Ome\Event\Values\SchemeStatus;

interface ListEventSchemeQuery
{
    /**
     * @param int|null $plannerId
     * @param SchemeStatus[]|null $status
     * @param DateTimeInterface|null $startAt
     * @param DateTimeInterface|null $endAt
     * @return array
     */
    public function fetch(
        ?int $plannerId,
        ?array $status,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt
    ): array;
}
