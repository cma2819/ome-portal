<?php

namespace Ome\Attendee\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class TaskScope implements ValueObject
{
    private string $scope;

    protected function __construct(
        string $scope
    ) {
        $this->scope = $scope;
    }

    public static function createFromValue(string $scope): self
    {
        switch ($scope) {
            case self::runner()->value():
                return self::runner();
            case self::commentator()->value():
                return self::commentator();
            case self::volunteer()->value():
                return self::volunteer();
            default:
                throw new UnmatchedContextException(self::class, "Scope [${scope}] is not matched task's scope.");
        }
    }

    public static function runner(): self
    {
        return new self('runner');
    }

    public static function commentator(): self
    {
        return new self('commentator');
    }

    public static function volunteer(): self
    {
        return new self('volunteer');
    }

    public function value()
    {
        return $this->scope;
    }

    public function equalsTo($opponent)
    {
        if (!($opponent instanceof self)) {
            return false;
        }

        return $this->value() === $opponent->value();
    }
}
