<?php

namespace Ome\Twitter\Values;

use InvalidArgumentException;
use Ome\ValueObject;

class TwitterMediaType implements ValueObject
{
    protected const VALUE_PHOTO = 'photo';
    protected const VALUE_VIDEO = 'video';
    protected const VALUE_ANIMATED_GIF = 'animated_gif';

    protected string $mediaType;

    protected function __construct(
        string $mediaType
    )
    {
        $this->mediaType = $mediaType;
    }

    public static function create(string $value): self
    {
        switch ($value) {
            case self::VALUE_PHOTO:
                return self::photo();
            case self::VALUE_VIDEO:
                return self::video();
            case self::VALUE_ANIMATED_GIF:
                return self::animatedGif();
            default:
                throw new InvalidArgumentException('Invalid media type:' . $value . '.');
        }
    }

    public static function photo(): self
    {
        return new self(self::VALUE_PHOTO);
    }

    public static function video(): self
    {
        return new self(self::VALUE_VIDEO);
    }

    public static function animatedGif(): self
    {
        return new self(self::VALUE_ANIMATED_GIF);
    }

    public function value()
    {
        return $this->mediaType;
    }

    public function equalsTo(self $opponent): bool
    {
        return $this->value() === $opponent->value();
    }
}
