<?php

namespace Ome\Attendee\Entities;

abstract class Task
{

    protected string $scope = '';

    private ?int $id;

    private string $content;

    protected function __construct(
        ?int $id,
        string $content
    ) {
        $this->id = $id;
        $this->content = $content;
    }

    public static function createNewTask(
        string $content
    ): self {
        return new self(null, $content);
    }

    public static function createRegistered(
        int $id,
        string $content
    ): self {
        return new self($id, $content);
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
