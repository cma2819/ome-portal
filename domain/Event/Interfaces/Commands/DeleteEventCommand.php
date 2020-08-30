<?php

namespace Ome\Event\Interfaces\Commands;

interface DeleteEventCommand
{
    public function execute(string $id): bool;
}
