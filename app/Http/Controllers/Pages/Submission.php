<?php

namespace App\Http\Controllers\Pages;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class Submission extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ?string $id = null)
    {
        if (!is_null($id) && is_null(AssociateEvent::find($id))) {
            return abort(404);
        }

        return view('submission.index');
    }
}
