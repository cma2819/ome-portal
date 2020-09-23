<?php

namespace Ome\Permission\Values;

use Ome\Exceptions\UnmatchedContextException;
use Ome\ValueObject;

class Domain implements ValueObject
{
    private string $domainName;

    protected function __construct(
        string $domainName
    ) {
        $this->domainName = $domainName;
    }

    public static function admin()
    {
        return new self('admin');
    }

    public static function twitter()
    {
        return new self('twitter');
    }

    public static function internalStream()
    {
        return new self('internal-stream');
    }

    public static function createFromValue(string $domain)
    {
        switch ($domain) {
            case Domain::twitter()->value():
                return Domain::twitter();
            case Domain::admin()->value():
                return Domain::admin();
            case Domain::internalStream()->value():
                return Domain::internalStream();
            default:
                throw new UnmatchedContextException(self::class, 'allowed domain name is not matched.');
        }
    }

    public function value()
    {
        return $this->domainName;
    }

    public function equalsTo($opponent)
    {
        if (!($opponent instanceof self)) {
            return false;
        }

        if ($opponent->value() === $this->value()) {
            return true;
        }

        return false;
    }
}
