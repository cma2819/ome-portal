<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthUseCase;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthRequest;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthResponse;
use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthUseCase;

class SetCommonViewData
{
    protected BuildDiscordOAuthUseCase $buildDiscordOAuth;

    protected BuildTwitchOAuthUseCase $buildTwitchOAuth;

    public function __construct(
        BuildDiscordOAuthUseCase $buildDiscordOAuth,
        BuildTwitchOAuthUseCase $buildTwitchOAuth
    ) {
        $this->buildDiscordOAuth = $buildDiscordOAuth;
        $this->buildTwitchOAuth = $buildTwitchOAuth;
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

        $twitchOauth = $this->buildTwitchOAuth->interact(
            new BuildTwitchOAuthRequest(
                config('services.twitch.client_id'),
                config('services.twitch.redirect_url'),
                ['user:read:email']
            )
        );
        $request->session()->put('twitch_state', $twitchOauth->getState());

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
            'twitch_oauth_url' => $twitchOauth->getOauthUrl(),
            'bearer' => $bearerToken,
        ]);

        return $next($request);
    }
}
