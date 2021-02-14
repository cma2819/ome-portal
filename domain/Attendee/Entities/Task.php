<?php

namespace Ome\Attendee\Entities;

abstract class Task
{
    protected string $scope;

    private ?int $id;

    private string $content;

    protected function __construct(
        ?int $id,
        string $content
    ) {
        $this->id = $id;
        $this->content = $content;
    }

    abstract public static function createNewTask(string $content): self;

    abstract public static function createRegistered(int $id, string $content): self;

    public function hasSameIdentityWith(Task $opponent): bool
    {
        return (
            $this->scope === $opponent->getScope()
            && $this->id === $opponent->getId()
        );
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Edit Task.
     *
     * @return self
     */
    public function edit(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
