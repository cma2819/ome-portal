<?php

namespace App\Http\Controllers\Api\Twitter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ome\Twitter\UseCases\GetTimelineInteractor;

class TweetResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetTimelineInteractor $getTimelineUseCase)
    {
        return $getTimelineUseCase->interact();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
