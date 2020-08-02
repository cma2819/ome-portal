<?php

namespace Ome\Twitter\Interfaces\Repositories;

use Ome\Twitter\Entities\TwitterMedia;
use Psr\Http\Message\UploadedFileInterface;

interface TwitterMediaRepository
{
    public function save(UploadedFileInterface $file): TwitterMedia;

    public function find(int $id): ?TwitterMedia;
}
