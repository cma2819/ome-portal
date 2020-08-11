<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMediaCommand;
use Ome\Twitter\Interfaces\Dto\UploadedMediaDto;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaRequest;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaResponse;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaUseCase;

class UploadMediaInteractor implements UploadMediaUseCase
{
    protected PersistTwitterMediaCommand $persistTwitterMediaCommand;

    public function __construct(
        PersistTwitterMediaCommand $persistTwitterMediaCommand
    ) {
        $this->persistTwitterMediaCommand = $persistTwitterMediaCommand;
    }

    public function interact(UploadMediaRequest $uploadMediaRequest): UploadMediaResponse
    {
        $twitterMedia = TwitterMedia::createUploadMedia(
            $uploadMediaRequest->getUrl(),
            $uploadMediaRequest->getMimeType()
        );

        $result = $this->persistTwitterMediaCommand->execute($twitterMedia);
        return new UploadMediaResponse(
            new UploadedMediaDto($result)
        );
    }
}
