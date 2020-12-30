<?php

namespace Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus;

use DateTimeInterface;

/**
 * Request object for ProceedEventSchemeStatus.
 */
class ProceedEventSchemeStatusRequest
{
    private int $id;

    private string $status;

    private string $proceedReply;

    private DateTimeInterface $now;

    public function __construct(
        int $id,
        string $status,
        string $proceedReply,
        DateTimeInterface $now
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->proceedReply = $proceedReply;
        $this->now = $now;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of proceedReply
     */
    public function getProceedReply()
    {
        return $this->proceedReply;
    }

    /**
     * Get the value of now
     */
    public function getNow()
    {
        return $this->now;
    }
}
