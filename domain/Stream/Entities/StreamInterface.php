<?php

namespace Ome\Stream\Entities;

interface StreamInterface
{
    public function getUserId(): string;

    public function getViewUri(): string;

    public function isLive(): bool;
}
