<?php

namespace Ome\Stream\Entities;

interface StreamUserInterface
{
    public function getUsername(): string;

    public function getUserPage(): string;
}
