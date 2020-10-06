<?php

namespace Ome\Attendee\Interfaces\Commands;

interface DeleteTaskCommand
{
    public function execute(int $id): bool;
}
