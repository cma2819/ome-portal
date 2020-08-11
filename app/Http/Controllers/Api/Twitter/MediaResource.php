<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Exceptions\Twitter\TwitterException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Twitter\MediaStoreRequest;
use App\Http\Responses\Api\Twitter\TwitterMediaResponse;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaRequest;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaUseCase;

class MediaResource extends Controller
{
    /**
     * Store new media for twitter.
     *
     * @param MediaStoreRequest $request
     * @param UploadMediaUseCase $updateMediaUseCase
     * @return array
     */
    public function store(
        MediaStoreRequest $request,
        UploadMediaUseCase $updateMediaUseCase
    ): array {
        $file = $request->media;
        try {
            $result = $updateMediaUseCase->interact(
                new UploadMediaRequest($file->getPathname(), $file->getClientMimeType())
            );
        } catch (TwitterException $e) {
            abort($e->getStatusCode());
        }

        return ['id' => $result->getUploadedMedia()->getId()];
    }
}
