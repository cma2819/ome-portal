<?php

namespace Ome\Twitter\Interfaces\UseCases\UploadMedia;

use Psr\Http\Message\UploadedFileInterface;

class UploadMediaRequest
{
    private UploadedFileInterface $file;

    public function __construct(
        UploadedFileInterface $file
    )
    {
        $this->file = $file;
    }

    /**
     * Get the value of file
     */
    public function getFile()
    {
        return $this->file;
    }
}
