<?php

namespace Tests;

trait AssertJsonArray
{
    public function assertJsonArray(array $json, string $key, array $expected)
    {
        $test = $json[$key];

        foreach ($expected as $exp) {
            $this->assertContains($exp, $test);
        }
    }
}
