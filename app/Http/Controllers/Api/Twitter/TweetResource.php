<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Exceptions\Twitter\TwitterException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Twitter\TweetStoreRequest;
use App\Http\Responses\Api\Twitter\TweetResponse;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetRequest;
use Ome\Twitter\Interfaces\UseCases\DeleteTweet\DeleteTweetUseCase;
use Ome\Twitter\Interfaces\UseCases\GetTimeline\GetTimelineUseCase;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetRequest;
use Ome\Twitter\Interfaces\UseCases\PostTweet\PostTweetUseCase;

class TweetResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TweetResponse[]
     */
    public function index(GetTimelineUseCase $getTimelineUseCase)
    {
        $timeline = $getTimelineUseCase->interact()->getTimeline();

        $response = [];
        foreach ($timeline as $tweetDto) {
            $response[] = new TweetResponse($tweetDto);
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostTweetUseCase $postTweetUseCase
     * @param TweetStoreRequest $request
     * @return TweetResponse
     */
    public function store(
        TweetStoreRequest $request,
        PostTweetUseCase $postTweetUseCase
    ) {
        try {
            return new TweetResponse($postTweetUseCase->interact(
                new PostTweetRequest($request->text, $request->mediaIds ?? [])
            )->getTweet());
        } catch (TwitterException $e) {
            abort($e->getStatusCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        int $id,
        DeleteTweetUseCase $deleteTweetUseCase
    ) {
        $result = $deleteTweetUseCase->interact(
            new DeleteTweetRequest($id)
        );
        if ($result->getResult()) {
            return response()->noContent();
        } else {
            abort(404);
        }
    }
}
