<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

use Ome\Twitter\Entities\TwitterMedia;
use Psr\Http\Message\UploadedFileInterface;

interface UploadMediaUseCase
{
    /**
     * Upload media to twitter.
     *
     * @param UploadMediaRequest $uploadMediaRequest
     * @return UploadMediaResponse
     */
    public function interact(UploadMediaRequest $uploadMediaRequest): UploadMediaResponse;
}
