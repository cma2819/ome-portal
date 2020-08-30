<?php

namespace Ome\Event\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class RelateType implements ValueObject
{
    private string $type;

    protected function __construct(
        string $type
    ) {
        $this->type = $type;
    }

    public static function moderate(): self
    {
        return new self('moderate');
    }

    public static function support(): self
    {
        return new self('support');
    }

    public static function createFromValue(string $value): self
    {
        switch ($value) {
            case self::moderate()->value():
                return self::moderate();
            case self::support()->value():
                return self::moderate();
            default:
                throw new UnmatchedContextException(self::class, 'Relate type is not matched.');
        }
    }

    public function value()
    {
        return $this->type;
    }

    public function equalsTo($opponent)
    {
        if (!($opponent instanceof self)) {
            return false;
        }
        return $this->value() === $opponent->value();
    }
}
