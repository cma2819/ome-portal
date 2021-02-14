<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class Scheme extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke() {
        return view('scheme.index');
    }
}
