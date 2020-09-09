<?php

namespace App\Http\Controllers\Pages;

use App\Eloquents\AssociateEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class Schedule extends Controller
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
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ?string $id = null)
    {
        $viewData = [
            'discord_oauth_url' => null,
            'bearer' => null,
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

        if (!is_null($id) && is_null(AssociateEvent::find($id))) {
            return abort(404);
        }

        return view('schedule.detail', $viewData);
    }
}
