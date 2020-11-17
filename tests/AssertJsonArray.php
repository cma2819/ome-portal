<?php

namespace Tests;

trait AssertJsonArray
{
    public function assertJsonArray(array $json, string $key, array $expected)
    {
        $keys = explode('.', $key);
        $test = $json;
        foreach ($keys as $k) {
            $test = $test[$k];
        }

        foreach ($expected as $exp) {
            $this->assertContains($exp, $test);
        }
    }
}
