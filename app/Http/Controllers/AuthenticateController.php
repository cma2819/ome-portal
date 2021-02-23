<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Auth\DiscordAuthenticateRequest;
use App\Http\Requests\Api\Auth\TwitchAuthenticateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserRequest;
use Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser\AuthenticateWithDiscordUserUseCase;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeRequest;
use Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode\ExchangeAuthenticateCodeUseCase;
use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserRequest;
use Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser\GetCurrentDiscordUserUseCase;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenRequest;
use Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken\AuthorizeTwitchByAccessTokenUseCase;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserRequest;
use Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser\ConnectTwitchToUserUseCase;
use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenRequest;
use Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken\ExchangeCodeToAccessTokenUseCase;

class AuthenticateController extends Controller
{
    public function discordAuth(
        DiscordAuthenticateRequest $request,
        ExchangeAuthenticateCodeUseCase $exchangeAuthenticateCode,
        GetCurrentDiscordUserUseCase $getCurrentDiscordUser,
        AuthenticateWithDiscordUserUseCase $authenticateWithDiscordUser
    ) {
        $accessToken = $exchangeAuthenticateCode->interact(
            new ExchangeAuthenticateCodeRequest(
                config('services.discord.client_id'),
                config('services.discord.client_secret'),
                $request->code,
                config('services.discord.redirect_url')
            )
        )->getAccessToken();

        $discordUser = $getCurrentDiscordUser->interact(
            new GetCurrentDiscordUserRequest($accessToken)
        )->getUser();

        $user = $authenticateWithDiscordUser->interact(
            new AuthenticateWithDiscordUserRequest($discordUser)
        )->getUser();

        $userEloquent = Auth::loginUsingId($user->getId());
        $userEloquent->refreshToken();
        $userEloquent->save();

        return $this->redirectToView($request);
    }

    public function twitchAuth(
        TwitchAuthenticateRequest $request,
        ExchangeCodeToAccessTokenUseCase $exchangeCodeToAccessTokenUseCase,
        AuthorizeTwitchByAccessTokenUseCase $authorizeTwitchByAccessTokenUseCase,
        ConnectTwitchToUserUseCase $connectTwitchToUserUseCase
    ) {
        $accessToken = $exchangeCodeToAccessTokenUseCase->interact(
            new ExchangeCodeToAccessTokenRequest(
                config('services.twitch.client_id'),
                config('services.twitch.client_secret'),
                $request->code,
                config('services.twitch.redirect_url')
            )
        )->getAccessToken();
        $twitchUser = $authorizeTwitchByAccessTokenUseCase->interact(
            new AuthorizeTwitchByAccessTokenRequest($accessToken)
        )->getTwitch();

        $connectTwitchToUserUseCase->interact(
            new ConnectTwitchToUserRequest(
                Auth::id(),
                $twitchUser
            )
        );

        return redirect(route('mypage'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('index'));
    }

    private function redirectToView(
        Request $request
    ) {
        if ($request->session()->has('login_redirect')) {
            $location = url($request->session()->pull('login_redirect'));
        } else {
            $location = route('index');
        }

        return redirect($location);
    }
}
