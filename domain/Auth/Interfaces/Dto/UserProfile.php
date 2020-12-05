<?php

namespace Ome\Auth\Interfaces\Dto;

use Ome\Auth\Entities\DiscordUser;

class UserProfile
{
    private int $id;

    private string $name;

    private DiscordUser $discord;

    public function __construct(
        int $id,
        string $name,
        DiscordUser $discord
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->discord = $discord;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of discord
     */
    public function getDiscord()
    {
        return $this->discord;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }
}
