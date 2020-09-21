<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamInternal extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        Request $request,
        string $id
    ) {

        $viewData = [
            'discord_oauth_url' => null,
            'bearer' => null,
        ];

        $streamHost = config('app.internal_stream_url');

        if (substr($streamHost, -1, 1) === '/') {
            $streamHost = substr($streamHost, 0, -1);
        }

        $viewData['streamUri'] = $streamHost . '/' . $id . '.flv';

        return view('stream.internal', $viewData);
    }
}
