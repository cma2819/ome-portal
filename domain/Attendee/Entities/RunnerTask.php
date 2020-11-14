<?php

namespace Ome\Attendee\Entities;

class RunnerTask extends Task
{
    protected string $scope = 'runner';

    public static function createNewTask(string $content): self
    {
        return new self(null, $content);
    }

    public static function createRegistered(int $id, string $content): self
    {
        return new self($id, $content);
    }
}
