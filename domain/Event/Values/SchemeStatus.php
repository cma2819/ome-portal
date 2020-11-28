<?php

namespace Ome\Event\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class SchemeStatus implements ValueObject
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
            case 'denied':
                return self::denied();
            case 'confirmed':
                return self::confirmed();
            default:
                throw new UnmatchedContextException(self::class, $status . ' is not match for SchemeStatus.');
        }
    }

    public static function applied(): self
    {
        return new self('applied');
    }

    public static function approved(): self
    {
        return new self('approved');
    }

    public static function confirmed(): self
    {
        return new self('confirmed');
    }

    public static function denied(): self
    {
        return new self('denied');
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

        if ($this->status === $opponent->value()) {
            return true;
        }
    }
}
