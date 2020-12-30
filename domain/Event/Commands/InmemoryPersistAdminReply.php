<?php

namespace Ome\Event\Commands;

use Ome\Event\Interfaces\Commands\PersistAdminReplyCommand;
use Ome\Event\Entities\AdminStatusReply;

class InmemoryPersistAdminReply implements PersistAdminReplyCommand
{
    /** @var AdminStatusReply[] */
    private array $adminReplies;

    public function __construct(
        array $adminReplies = []
    ) {
        $this->adminReplies = $adminReplies;
    }

    public function execute(AdminStatusReply $adminStatusReply): AdminStatusReply
    {
        $this->adminReplies[] = $adminStatusReply;
        return $adminStatusReply;
    }

    /**
     * Get the value of adminReplies
     */
    public function getAdminReplies()
    {
        return $this->adminReplies;
    }
}
