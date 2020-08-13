<?php

namespace Ome\Permission\Values;

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
