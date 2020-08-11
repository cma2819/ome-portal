<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Dto\UploadedMediaDto;

class UploadMediaResponse
{
    private UploadedMediaDto $uploadedMedia;

    public function __construct(
        UploadedMediaDto $uploadedMedia
    ) {
        $this->uploadedMedia = $uploadedMedia;
    }

    /**
     * Get the value of uploadedMedia
     */
    public function getUploadedMedia()
    {
        return $this->uploadedMedia;
    }
}
