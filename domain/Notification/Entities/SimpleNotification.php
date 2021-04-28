<?php

namespace Ome\Notification\Entities;

use Ome\Notification\Templates\Template;

class SimpleNotification implements Notifiable
{
    protected Template $subject;

    protected Template $message;

    protected function __construct(
        Template $subject,
        Template $message
    ) {
        $this->subject = $subject;
        $this->message = $message;
    }

    public static function create(
        Template $subject,
        Template $message
    ): self {
        return new self($subject, $message);
    }

    public function getSubject(): string
    {
        return $this->subject->toString();
    }

    public function getMessage(): string
    {
        return $this->message->toString();
    }
}
