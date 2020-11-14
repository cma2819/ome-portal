<?php

namespace Ome\Attendee\Entities;

class CommentatorTask extends Task
{
    protected string $scope = 'commentator';

    public static function createNewTask(string $content): self
    {
        return new self(null, $content);
    }

    public static function createRegistered(int $id, string $content): self
    {
        return new self($id, $content);
    }
}
