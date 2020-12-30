<?php

namespace App\Infrastructure\Commands\Event;

use App\Infrastructure\Eloquents\EventScheme as EventSchemeEloquent;
use App\Infrastructure\Eloquents\EventSchemeReply as EventSchemeReplyEloquent;
use Ome\Event\Entities\AdminStatusReply;
use Ome\Event\Interfaces\Commands\PersistAdminReplyCommand;

class DbPersistAdminReplyCommand implements PersistAdminReplyCommand
{
    public function execute(AdminStatusReply $adminStatusReply): AdminStatusReply
    {
        $scheme = EventSchemeEloquent::findOrFail($adminStatusReply->getSchemeId());

        $scheme->adminReplies()->save(
            new EventSchemeReplyEloquent([
                'to_status' => $adminStatusReply->getToStatus()->value(),
                'admin_reply' => $adminStatusReply->getReply(),
                'replied_at' => $adminStatusReply->getReplyAt(),
            ])
        );

        return $adminStatusReply;
    }
}
