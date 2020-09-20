<?php

namespace Ome\Attendee\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class ProgressStatus implements ValueObject
{
    private string $status;

    protected function __construct(string $status)
    {
        $this->status = $status;
    }

    public static function createFromValue(string $status): self
    {
        switch ($status) {
            case self::apply()->value():
                return self::apply();
            case self::approval()->value():
                return self::approval();
            case self::deny()->value():
                return self::deny();
            default:
                throw new UnmatchedContextException(self::class, "Status [${status}] is not matched progress status.");
        }
    }

    public static function apply(): self
    {
        return new self('apply');
    }

    public static function approval(): self
    {
        return new self('approval');
    }

    public static function deny(): self
    {
        return new self('deny');
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
