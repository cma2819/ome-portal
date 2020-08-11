<?php

namespace Ome\Twitter\Entities;

use JsonSerializable;

class TwitterUser implements JsonSerializable
{
    protected string $id;

    protected string $name;

    protected string $screenName;

    protected function __construct(
        string $id,
        string $name,
        string $screenName
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->screenName = $screenName;
    }

    public static function createFromApiJson(
        array $json
    ): self {
        return new self(
            $json['id'],
            $json['name'],
            $json['screen_name']
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'screenName' => $this->screenName,
        ];
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

    /**
     * Get the value of screenName
     */
    public function getScreenName()
    {
        return $this->screenName;
    }
}
