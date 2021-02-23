<?php

namespace Ome\Stream\Entities;

class TwitchUser implements StreamUserInterface
{
    private string $id;

    private string $username;

    private string $displayName;

    protected function __construct(
        string $id,
        string $username,
        string $displayName
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->displayName = $displayName;
    }

    public static function createFromJson(
        array $json
    ): self {
        return new self(
            $json['id'],
            $json['login'],
            $json['display_name']
        );
    }

    public static function createRegistered(
        string $id,
        string $username,
        string $displayName
    ): self {
        return new self(
            $id,
            $username,
            $displayName
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
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the value of displayName
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function getUserPage(): string
    {
        return Twitch::makeViewUri($this->username);
    }
}
