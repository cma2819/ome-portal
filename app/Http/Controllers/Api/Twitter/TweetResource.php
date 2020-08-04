<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Twitter\TweetStoreRequest;
use Illuminate\Http\Request;
use Ome\Twitter\Interfaces\UseCases\GetTimelineUseCase;
use Ome\Twitter\Interfaces\UseCases\PostTweetUseCase;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        PostTweetUseCase $postTweetUseCase,
        TweetStoreRequest $request
    )
    {
        return $postTweetUseCase->interact($request->text, $request->mediaIds);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
