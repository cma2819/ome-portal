<?php

namespace Ome\Stream\Entities;

use Ome\Exceptions\UnmatchedContextException;

class Streamer
{
    private int $id;

    /** @var TwitchUser[] */
    private array $twitch;

    /** @var StreamInterface[] */
    private array $streams;

    /**
     * @param integer $id
     * @param TwitchUser[] $twitch
     * @param StreamInterface[] $streams
     */
    protected function __construct(
        int $id,
        array $twitch = [],
        array $streams = []
    ) {
        $this->id = $id;
        $this->twitch = [];
        foreach ($twitch as $tw) {
            $this->twitch[$tw->getId()] = $tw;
        }
        $this->streams = $streams;
    }

    public static function createNewStreamer(
        int $userId
    ): self {
        return new self($userId);
    }

    /**
     * @param integer $id
     * @param TwitchUser[] $twitch
     * @param StreamInterface[] $streams
     * @return self
     */
    public static function createRegisteredStreamer(
        int $id,
        array $twitch,
        array $streams
    ): self {
        return new self(
            $id,
            $twitch,
            $streams
        );
    }

    public function addTwitchUser(TwitchUser $user): self
    {
        $this->twitch[$user->getId()] = $user;
        return $this;
    }

    public function removeTwitchUser(TwitchUser $user): self
    {
        unset($this->twitch[$user->getId()]);
        return $this;
    }

    public function addLive(StreamInterface $live): self
    {
        if ($live instanceof Twitch) {
            foreach ($this->twitch as $tw) {
                if ($live->getUserId() === $tw->getId()) {
                    break;
                }
            }
            throw new UnmatchedContextException(
                self::class,
                "Twitch channel[{$live->getId()}] is not by user[{$this->id}]."
            );
        }
        $this->streams[] = $live;
        return $this;
    }

    /**
     * @return StreamInterface[]
     */
    public function getLives(): array
    {
        $lives = [];
        foreach ($this->streams as $stream) {
            if ($stream->isLive()) {
                $lives[] = $stream;
            }
        }

        return $lives;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of twitch
     */
    public function getTwitch()
    {
        return $this->twitch;
    }

    /**
     * Get the value of streams
     */
    public function getStreams()
    {
        return $this->streams;
    }
}
