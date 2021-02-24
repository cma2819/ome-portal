<?php

namespace Ome\Auth\Entities;

class User
{
    private ?int $id;

    private string $username;

    private string $discordId;

    private array $twitchIds;

    /**
     * @param integer|null $id
     * @param string $username
     * @param string $discordId
     * @param string[] $twitchIds
     */
    protected function __construct(
        ?int $id,
        string $username,
        string $discordId,
        array $twitchIds
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->discordId = $discordId;
        $this->twitchIds = $twitchIds;
    }

    public static function createRegisteredUser(
        int $id,
        string $username,
        string $discordId,
        array $twitchIds
    ) {
        return new self($id, $username, $discordId, $twitchIds);
    }

    public static function createFromDiscordUser(DiscordUser $discord)
    {
        return new self(null, $discord->getUsername(), $discord->getId(), []);
    }

    public function edit(
        string $username
    ): self {
        $this->username = $username;
        return $this;
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

    /**
     * Get the value of twitchIds
     */
    public function getTwitchIds()
    {
        return $this->twitchIds;
    }
}
