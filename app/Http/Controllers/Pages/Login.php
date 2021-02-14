<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRedirectRequest;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class Login extends Controller
{
    protected BuildDiscordOAuthUseCase $buildDiscordOAuth;

    public function __construct(
        BuildDiscordOAuthUseCase $buildDiscordOAuth
    ) {
        $this->buildDiscordOAuth = $buildDiscordOAuth;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRedirectRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('index'));
        }

        if (!is_null($request->access_to)) {
            $request->session()->put('login_redirect', $request->access_to);
        }

        return view('login');
    }
}
