<?php

namespace Ome\Event\Interfaces\Commands;

use Ome\Event\Entities\AdminStatusReply;

interface PersistAdminReplyCommand
{
    public function execute(AdminStatusReply $adminStatusReply): AdminStatusReply;
}
