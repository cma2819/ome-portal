<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMedia\PersistTwitterMediaCommand;
use Ome\Twitter\Interfaces\Commands\PersistTwitterMedia\PersistTwitterMediaInput;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaRequest;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaResponse;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaUseCase;

class UploadMediaInteractor implements UploadMediaUseCase
{

    protected PersistTwitterMediaCommand $persistTwitterMediaCommand;

    public function __construct(
        PersistTwitterMediaCommand $persistTwitterMediaCommand
    )
    {
        $this->persistTwitterMediaCommand = $persistTwitterMediaCommand;
    }

    public function interact(UploadMediaRequest $uploadMediaRequest): UploadMediaResponse
    {
        $uploadFile = $uploadMediaRequest->getFile();
        $twitterMedia = TwitterMedia::createNewMediaFromUploadedFile($uploadFile);
        $input = new PersistTwitterMediaInput($twitterMedia);
        return new UploadMediaResponse(
            $this->persistTwitterMediaCommand->execute($input)->getTwitterMedia()
        );
    }
}
