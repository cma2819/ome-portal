<?php

namespace Ome\Twitter\Interfaces\Commands;

interface DeleteTweetCommand
{
    public function execute(int $id): bool;
}
