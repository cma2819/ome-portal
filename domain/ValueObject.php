<?php

namespace Ome;

interface ValueObject
{
    public function value();

    public function equalsTo($opponent);
}
