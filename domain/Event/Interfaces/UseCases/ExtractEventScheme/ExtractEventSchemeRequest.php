<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventScheme;

use DateTimeInterface;
use Ome\Event\Values\SchemeStatus;

/**
 * Request object for ExtractEventScheme.
 */
class ExtractEventSchemeRequest
{
    private ?int $plannerId;

    /** @var SchemeStatus[]|null */
    private ?array $status;

    private ?DateTimeInterface $startAt;

    private ?DateTimeInterface $endAt;

    /**
     * @param integer|null $plannerId
     * @param string[]|null $status
     * @param DateTimeInterface|null $startAt
     * @param DateTimeInterface|null $endAt
     */
    public function __construct(
        ?int $plannerId = null,
        ?array $status = null,
        ?DateTimeInterface $startAt = null,
        ?DateTimeInterface $endAt = null
    ) {
        $this->plannerId = $plannerId;

        if (is_array($status)) {
            $this->status = [];
            foreach ($status as $st) {
                $this->status[] = SchemeStatus::createFromValue($st);
            }
        } else {
            $this->status = $status;
        }

        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
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
     * Get the value of plannerId
     */
    public function getPlannerId()
    {
        return $this->plannerId;
    }
}
