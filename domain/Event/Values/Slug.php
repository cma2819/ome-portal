<?php

namespace Ome\Event\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class Slug implements ValueObject
{
    private string $slug;

    protected function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    public static function create(string $slug): self
    {
        if (count(explode(' ', $slug)) !== 1) {
            throw new UnmatchedContextException(self::class, 'Not match pattern slug.');
        }
        return new self($slug);
    }

    public function value()
    {
        return $this->slug;
    }

    public function equalsTo($opponent)
    {
        if (!($opponent instanceof self)) {
            return false;
        }
        return $this->value() === $opponent->value();
    }
}
