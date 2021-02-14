<?php

namespace App\Http\Controllers\Pages;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Http\Controllers\Controller;

class Event extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(?string $id = null)
    {
        if (!is_null($id) && is_null(AssociateEvent::find($id))) {
            return abort(404);
        }

        return view('event.index');
    }
}
