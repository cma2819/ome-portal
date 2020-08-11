<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

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
