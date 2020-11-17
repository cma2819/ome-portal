<?php

namespace Ome\Attendee\Entities;

class User
{
    private int $id;

    private string $username;

    protected function __construct(
        int $id,
        string $username
    ) {
        $this->id = $id;
        $this->username = $username;
    }

    public static function create(
        int $id,
        string $username
    ) {
        return new self($id, $username);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }
}
