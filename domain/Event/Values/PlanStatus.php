<?php

namespace Ome\Event\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class PlanStatus implements ValueObject
{
    private string $status;

    protected function __construct(
        string $status
    ) {
        $this->status = $status;
    }

    public static function createFromValue(string $status): self
    {
        switch ($status) {
            case 'applied':
                return self::applied();
            case 'approved':
                return self::approved();
            default:
                throw new UnmatchedContextException(self::class, $status . ' is not match for SchemeStatus.');
        }
    }

    public static function default(): self
    {
        return self::applied();
    }

    public static function applied(): self
    {
        return new self('applied');
    }

    public static function approved(): self
    {
        return new self('approved');
    }

    public function value()
    {
        return $this->status;
    }

    public function equalsTo($opponent)
    {
        if (!$opponent instanceof self) {
            return false;
        }

        return $this->value() === $opponent->value();
    }
}
