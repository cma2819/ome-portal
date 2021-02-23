<?php

namespace Ome\Stream\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class StreamStatus implements ValueObject
{
    private string $status;

    protected function __construct(
        string $status
    ) {
        $this->status = $status;
    }

    public static function createFromValue(string $value): self
    {
        switch ($value) {
            case 'offline':
                return self::offline();
            case 'live':
                return self::live();
            default:
                throw new UnmatchedContextException(self::class, 'Status: ' . $value . ' is not matched to StreamStatus.');
        }
    }

    public static function offline(): self
    {
        return new self('offline');
    }

    public static function live(): self
    {
        return new self('live');
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
