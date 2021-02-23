<?php

namespace Ome\Auth\Entities;

class DiscordUser
{
    private string $id;

    private string $username;

    private string $discriminator;

    private ?string $avatar;

    protected function __construct(
        string $id,
        string $username,
        string $discriminator,
        ?string $avatar
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->discriminator = $discriminator;
        $this->avatar = $avatar;
    }

    public static function createFromApiJson(array $json)
    {
        return new self(
            $json['id'],
            $json['username'],
            $json['discriminator'],
            $json['avatar']
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

    /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getThumbnail(string $discordCdnUrl): string
    {
        $baseUrl = substr($discordCdnUrl, -1) === '/' ? substr($discordCdnUrl, 0, -1) : $discordCdnUrl;

        if (is_null($this->avatar)) {
            $discriminatorMods = intval($this->discriminator) % 5;
            return $baseUrl . "/embed/avatars/{$discriminatorMods}.png";
        }

        return $baseUrl . "/avatars/{$this->id}/{$this->avatar}.png";
    }
}
