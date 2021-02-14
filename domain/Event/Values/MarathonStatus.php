<?php

namespace Ome\Event\Values;

use Ome\ValueObject;

class MarathonStatus implements ValueObject
{
    private string $status;

    protected function __construct(
        string $status
    ) {
        $this->status = $status;
    }

    public static function freshed(): self
    {
        return new self('freshed');
    }

    public static function selected(): self
    {
        return new self('selected');
    }

    public static function scheduled(): self
    {
        return new self('scheduled');
    }

    public static function closed(): self
    {
        return new self('closed');
    }

    public static function createFromCondition(
        bool $selected,
        bool $scheduled,
        bool $endBefore
    ): self {
        if ($endBefore) {
            return self::closed();
        }
        if ($scheduled) {
            return self::scheduled();
        }
        if ($selected) {
            return self::selected();
        }

        return self::freshed();
    }

    public function value()
    {
        return $this->status;
    }

    public function equalsTo($opponent)
    {
        if (!($opponent instanceof self)) {
            return false;
        }

        return $this->value() === $opponent->value();
    }
}
