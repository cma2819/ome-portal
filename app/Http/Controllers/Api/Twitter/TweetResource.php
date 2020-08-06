<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Twitter\TweetStoreRequest;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index(GetTimelineUseCase $getTimelineUseCase)
    {
        return $getTimelineUseCase->interact();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostTweetUseCase $postTweetUseCase
     * @param TweetStoreRequest $request
     * @return void
     */
    public function store(
        PostTweetUseCase $postTweetUseCase,
        TweetStoreRequest $request
    ) {
        return $postTweetUseCase->interact(
            new PostTweetRequest($request->text, $request->mediaIds)
        );
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
        if ($result) {
            return response()->noContent();
        } else {
            abort(404);
        }
    }
}
