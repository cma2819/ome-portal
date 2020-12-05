<?php

namespace App\Http\Controllers\Api\Schemes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Schemes\SchemeCreateRequest;
use App\Http\Requests\Api\Schemes\SchemeIndexRequest;
use App\Http\Responses\Api\Auth\DiscordProfileResponse;
use App\Http\Responses\Api\Auth\UserProfileResponse;
use App\Http\Responses\Api\Schemes\SchemeResponse;
use App\Infrastructure\Eloquents\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileRequest;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileUseCase;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeUseCase;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeRequest;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeUseCase;

class SchemeResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        SchemeIndexRequest $request,
        ExtractEventSchemeUseCase $extractEventScheme,
        GetUserProfileUseCase $getUserProfile
    ) {
        $planner = $request->planner;

        /** @var User */
        $user = Auth::user();
        if (!$user->can('access-to-admin')) {
            $planner = $user->id;
        }
        $schemes = $extractEventScheme->interact(
            new ExtractEventSchemeRequest(
                $planner,
                $request->status,
                $request->startAt,
                $request->endAt
            )
        )->getEventSchemes();

        $responses = [];
        foreach ($schemes as $scheme) {
            $userProfile = $getUserProfile->interact(
                new GetUserProfileRequest($scheme->getPlannerId())
            )->getProfile();

            $responses[] = new SchemeResponse(
                $userProfile,
                $scheme
            );
        }

        return $responses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        SchemeCreateRequest $request,
        ApplyEventSchemeUseCase $applyEventScheme,
        GetUserProfileUseCase $getUserProfile
    ) {
        /** @var User */
        $user = Auth::user();

        $result = $applyEventScheme->interact(
            new ApplyEventSchemeRequest(
                $user->id,
                $request->name,
                $request->startAt ? Carbon::parse($request->startAt) : null,
                $request->endAt ? Carbon::parse($request->endAt) : null,
                $request->explanation
            )
        )->getScheme();

        $profile = $getUserProfile->interact(
            new GetUserProfileRequest($user->id)
        )->getProfile();

        return new SchemeResponse(
            $profile,
            $result
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
