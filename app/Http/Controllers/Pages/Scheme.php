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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        Request $request,
        BuildDiscordOAuthUseCase $buildDiscordOAuth
    ) {
        $viewData = [
            'discord_oauth_url' => null,
            'bearer' => null,
        ];

        if (!Auth::check()) {
            $buildResult = $buildDiscordOAuth->interact(
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

        return view('scheme.index', $viewData);
    }
}
