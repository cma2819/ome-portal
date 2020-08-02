<?php

namespace Ome\Twitter\UseCases;

use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Interfaces\UseCases\UploadMediaUseCase;
use Psr\Http\Message\UploadedFileInterface;

class UploadMediaInteractor implements UploadMediaUseCase
{

    protected TwitterMediaRepository $twitterMediaRepository;

    public function __construct(
        TwitterMediaRepository $twitterMediaRepository
    )
    {
        $this->twitterMediaRepository = $twitterMediaRepository;
    }

    public function interact(UploadedFileInterface $file): TwitterMedia
    {
        return $this->twitterMediaRepository->save($file);
    }
}
