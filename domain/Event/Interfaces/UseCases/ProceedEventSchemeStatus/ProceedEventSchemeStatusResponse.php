<?php

namespace Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus;

use Ome\Event\Entities\AdminStatusReply;
use Ome\Event\Entities\EventScheme;

/**
 * Response object for ProceedEventSchemeStatus.
 */
class ProceedEventSchemeStatusResponse
{
    private EventScheme $scheme;

    private AdminStatusReply $reply;

    public function __construct(
        EventScheme $scheme,
        AdminStatusReply $reply
    ) {
        $this->scheme = $scheme;
        $this->reply = $reply;
    }

    /**
     * Get the value of scheme
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Get the value of reply
     */
    public function getReply()
    {
        return $this->reply;
    }
}
