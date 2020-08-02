<?php

namespace Ome\Twitter\Interfaces\UseCases;

use Ome\Twitter\Entities\TwitterMedia;
use Psr\Http\Message\UploadedFileInterface;

interface UploadMediaUseCase
{
    /**
     * Upload media to twitter.
     *
     * @param UploadedFileInterface $file
     * @return TwitterMedia
     */
    public function interact(UploadedFileInterface $file): TwitterMedia;
}
