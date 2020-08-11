<?php

namespace Ome\Auth\Entities;

class User
{
    private ?int $id;

    private string $username;

    private string $discordId;

    protected function __construct(
        ?int $id,
        string $username,
        string $discordId
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->discordId = $discordId;
    }

    public static function createRegisteredUser(
        int $id,
        string $username,
        string $discordId
    ) {
        return new self($id, $username, $discordId);
    }

    public static function createFromDiscordUser(DiscordUser $discord)
    {
        return new self(null, $discord->getUsername(), $discord->getId());
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

    /**
     * Get the value of discordId
     */
    public function getDiscordId()
    {
        return $this->discordId;
    }
}
