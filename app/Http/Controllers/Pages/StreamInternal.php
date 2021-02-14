<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamInternal extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        string $id
    ) {

        $viewData = [];

        $streamHost = config('app.internal_stream_url');

        if (substr($streamHost, -1, 1) === '/') {
            $streamHost = substr($streamHost, 0, -1);
        }

        $viewData['streamId'] = $id;
        $viewData['streamUri'] = $streamHost . '/' . $id . '.flv';

        return view('stream.internal', $viewData);
    }
}
