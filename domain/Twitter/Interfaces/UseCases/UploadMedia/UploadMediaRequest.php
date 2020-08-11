<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

use Psr\Http\Message\UploadedFileInterface;

class UploadMediaRequest
{

    private string $url;

    private string $mimeType;

    public function __construct(
        string $url,
        string $mimeType
    ) {
        $this->url = $url;
        $this->mimeType = $mimeType;
    }


    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of mimeType
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
}
