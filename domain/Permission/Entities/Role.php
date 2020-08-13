<?php

namespace Ome\Permission\Entities;

class Role
{
    private string $id;

    private string $name;

    protected function __construct(
        string $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function createFromApiJson(
        array $json
    ): self {
        return new self($json['id'], $json['name']);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }
}
