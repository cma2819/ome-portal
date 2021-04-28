<?php

namespace Ome\Notification\Templates\Event;

use Ome\Notification\Templates\Template;

class ApplyEventPlanMessage implements Template
{
    private string $message;

    public function __construct(
        string $explanation
    ) {
        $this->message = '```' . PHP_EOL
            . $explanation . PHP_EOL
            . '```';
    }

    public function toString(): string
    {
        return $this->message;
    }
}
