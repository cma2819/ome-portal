<?php

namespace Ome\Notification\Templates\Event;

use Ome\Notification\Templates\Template;

class ApplyEventSchemeMessage implements Template
{
    private string $message;

    public function __construct(
        string $name,
        string $username,
        string $explanation
    ) {
        $this->message =
        "新規のイベント応募が作成されました。" . PHP_EOL .
        "イベント名: {$name}" . PHP_EOL .
        "応募者: {$username}" . PHP_EOL .
        "イベント説明:" . PHP_EOL .
        "```" . PHP_EOL .
        "{$explanation}" . PHP_EOL .
        "```";
    }

    public function toString(): string
    {
        return $this->message;
    }
}
