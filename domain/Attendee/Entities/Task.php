<?php

namespace Ome\Attendee\Entities;

abstract class Task
{

    protected string $scope;

    private ?int $id;

    private string $content;

    protected function __construct(
        ?int $id,
        string $content,
        string $scope
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->scope = $scope;
    }

    abstract public static function createNewTask(string $content): self;

    abstract public static function createRegistered(int $id, string $content): self;

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
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
