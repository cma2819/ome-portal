<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class Top extends Controller
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
    public function __invoke(Request $request)
    {
        $viewData = [
            'discord_oauth_url' => null,
            'bearer' => null
        ];

        if (!Auth::check()) {
            $buildResult = $this->buildDiscordOAuth->interact(
                new BuildDiscordOAuthRequest(
                    config('services.discord.client_id'),
                    config('services.discord.redirect_url')
                )
            );

            $request->session()->put('discord_state', $buildResult->getState());
            $viewData['discord_oauth_url'] = $buildResult->getOauthUrl();
        } else {
            $user = Auth::user();
            $bearer = $user->api_token;

            $viewData['bearer'] = $bearer;
        }

        return view('index', $viewData);
    }
}
