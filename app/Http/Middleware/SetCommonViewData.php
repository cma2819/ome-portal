<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;

class SetCommonViewData
{
    protected BuildDiscordOAuthUseCase $buildDiscordOAuth;

    public function __construct(
        BuildDiscordOAuthUseCase $buildDiscordOAuth
    ) {
        $this->buildDiscordOAuth = $buildDiscordOAuth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $discordOauthUrl = null;
        $bearerToken = null;

        if (!Auth::check()) {
            $buildResult = $this->buildDiscordOAuth->interact(
                new BuildDiscordOAuthRequest(
                    config('services.discord.client_id'),
                    config('services.discord.redirect_url')
                )
            );

            $request->session()->put('discord_state', $buildResult->getState());
            $discordOauthUrl = $buildResult->getOauthUrl();
        } else {
            $user = Auth::user();
            $bearer = $user->api_token;

            $bearerToken = $bearer;
        }

        View::share([
            'discord_oauth_url' => $discordOauthUrl,
            'bearer' => $bearerToken,
        ]);

        return $next($request);
    }
}
