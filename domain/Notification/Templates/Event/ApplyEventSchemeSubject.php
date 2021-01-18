<?php

namespace Ome\Notification\Templates\Event;

use Ome\Notification\Templates\Template;

class ApplyEventSchemeSubject implements Template
{

    private string $subject;

    public function __construct(
        int $id
    ) {
        $this->subject = "イベント応募通知 [ID={$id}]";
    }

    public function toString(): string
    {
        return $this->subject;
    }
}
