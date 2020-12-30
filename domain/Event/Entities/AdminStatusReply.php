<?php

namespace Ome\Event\Entities;

use DateTimeInterface;
use Ome\Event\Values\SchemeStatus;

class AdminStatusReply
{
    private int $schemeId;

    private SchemeStatus $toStatus;

    private string $reply;

    private DateTimeInterface $replyAt;

    protected function __construct(
        SchemeStatus $toStatus,
        int $schemeId,
        string $reply,
        DateTimeInterface $replyAt
    ) {
        $this->toStatus = $toStatus;
        $this->schemeId = $schemeId;
        $this->reply = $reply;
        $this->replyAt = $replyAt;
    }

    public static function createApproveReply(
        int $schemeId,
        string $reply,
        DateTimeInterface $now
    ): self {
        return new self(SchemeStatus::approved(), $schemeId, $reply, $now);
    }

    public static function createConfirmReply(
        int $schemeId,
        string $reply,
        DateTimeInterface $now
    ): self {
        return new self(SchemeStatus::confirmed(), $schemeId, $reply, $now);
    }

    public static function createDenyReply(
        int $schemeId,
        string $reply,
        DateTimeInterface $now
    ): self {
        return new self(SchemeStatus::denied(), $schemeId, $reply, $now);
    }

    /**
     * Get the value of toStatus
     */
    public function getToStatus()
    {
        return $this->toStatus;
    }

    /**
     * Get the value of reply
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * Get the value of schemeId
     */
    public function getSchemeId()
    {
        return $this->schemeId;
    }

    /**
     * Get the value of replyAt
     */
    public function getReplyAt()
    {
        return $this->replyAt;
    }
}
