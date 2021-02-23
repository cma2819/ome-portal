<?php

namespace Ome\Stream\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use Ome\Stream\Values\StreamStatus;

class Twitch implements StreamInterface
{
    private string $id;

    private string $userId;

    private string $game;

    private string $title;

    private ?string $viewUri;

    private ?int $viewers;

    private ?string $thumbnail;

    private StreamStatus $status;

    private DateTimeInterface $startedAt;

    private ?DateTimeInterface $finishedAt;

    protected function __construct(
        string $id,
        string $userId,
        string $game,
        string $title,
        ?string $viewUri,
        ?int $viewers,
        ?string $thumbnail,
        StreamStatus $status,
        DateTimeInterface $startedAt,
        ?DateTimeInterface $finishedAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->game = $game;
        $this->title = $title;
        $this->viewUri = $viewUri;
        $this->viewers = $viewers;
        $this->thumbnail = $thumbnail;
        $this->status = $status;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
    }

    public static function createLiveFromJson(
        array $json
    ): self {
        return new self(
            $json['id'],
            $json['user_id'],
            $json['game_name'],
            $json['title'],
            self::makeViewUri($json['user_login']),
            $json['viewer_count'],
            $json['thumbnail_url'],
            StreamStatus::live(),
            Carbon::make($json['started_at']),
            null
        );
    }

    public static function createLiveRegistered(
        string $id,
        string $userId,
        string $game,
        string $title,
        string $username,
        int $viewers,
        string $thumbnail,
        DateTimeInterface $startedAt
    ): self {
        return new self(
            $id,
            $userId,
            $game,
            $title,
            self::makeViewUri($username),
            $viewers,
            $thumbnail,
            StreamStatus::live(),
            $startedAt,
            null
        );
    }

    public static function createOfflineRegistered(
        string $id,
        string $userId,
        string $game,
        string $title,
        DateTimeInterface $startedAt,
        DateTimeInterface $finishedAt
    ): self {
        return new self(
            $id,
            $userId,
            $game,
            $title,
            null,
            null,
            null,
            StreamStatus::offline(),
            $startedAt,
            $finishedAt
        );
    }

    public function finishLive(
        DateTimeInterface $finishedAt
    ): self {
        $this->viewUri = null;
        $this->viewers = null;
        $this->thumbnail = null;
        $this->status = StreamStatus::offline();
        $this->finishedAt = $finishedAt;

        return $this;
    }

    public static function makeViewUri(
        string $username
    ): string {
        return 'https://www.twitch.tv/' . $username;
    }

    public function isLive(): bool
    {
        return $this->status->equalsTo(StreamStatus::live());
    }

    public static function isLiveFromStatus(string $status): bool
    {
        return StreamStatus::createFromValue($status)->equalsTo(StreamStatus::live());
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of viewers
     */
    public function getViewers()
    {
        return $this->viewers;
    }

    /**
     * Get the value of thumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of startedAt
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Get the value of finishedAt
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Get the value of viewUri
     */
    public function getViewUri(): string
    {
        return $this->viewUri;
    }

    /**
     * Get the value of userId
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
