<?php

namespace Ome\Notification\Entities;

interface Notifiable
{
    public function getSubject(): string;

    public function getMessage(): string;
}
