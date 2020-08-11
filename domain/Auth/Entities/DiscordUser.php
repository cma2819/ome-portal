<?php

namespace Ome\Auth\Entities;

class DiscordUser
{
    private string $id;

    private string $username;

    private string $discriminator;

    protected function __construct(
        string $id,
        string $username,
        string $discriminator
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->discriminator = $discriminator;
    }

    public static function createFromApiJson(array $json)
    {
        return new self(
            $json['id'],
            $json['username'],
            $json['discriminator']
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of discriminator
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }
}
