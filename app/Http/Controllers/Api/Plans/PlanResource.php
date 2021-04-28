<?php

namespace App\Http\Controllers\Api\Plans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Plans\PlanCreateRequest;
use App\Http\Requests\Api\Plans\PlanIndexRequest;
use App\Http\Responses\Api\Auth\DiscordProfileResponse;
use App\Http\Responses\Api\Auth\UserProfileResponse;
use App\Http\Responses\Api\ErrorResponse;
use App\Http\Responses\Api\Errors\UnauthorizedErrorResponse;
use App\Http\Responses\Api\Plans\PlanResponse;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileRequest;
use Ome\Auth\Interfaces\UseCases\GetUserProfile\GetUserProfileUseCase;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanRequest;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanUseCase;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanRequest;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanUseCase;
use Ome\Exceptions\EntityNotFoundException;
use Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification\SendApplyPlanNotificationRequest;
use Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification\SendApplyPlanNotificationUseCase;
use Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationUseCase;

class PlanResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        PlanIndexRequest $request,
        ExtractEventPlanUseCase $extractEventPlanUseCase,
        GetUserProfileUseCase $getUserProfileUseCase
    ) {
        $planner = $request->planner;

        /** @var User */
        $user = Auth::user();
        if (!$user->canAccessToAdmin()) {
            $planner = $user->id;
        }

        $plans = $extractEventPlanUseCase->interact(
            new ExtractEventPlanRequest(
                $planner,
                $request->status
            )
        )->getEventPlans();

        $responses = [];
        foreach ($plans as $plan) {
            $userProfile = $getUserProfileUseCase->interact(
                new GetUserProfileRequest($plan->getPlannerId())
            )->getProfile();

            $responses[] = new PlanResponse(
                $plan->getId(),
                $plan->getName(),
                new UserProfileResponse(
                    $userProfile->getId(),
                    $userProfile->getName(),
                    new DiscordProfileResponse(
                        $userProfile->getDiscord()->getId(),
                        $userProfile->getDiscord()->getUsername(),
                        $userProfile->getDiscord()->getDiscriminator()
                    )
                ),
                $plan->getStatus(),
                $plan->getExplanation()
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
        PlanCreateRequest $request,
        GetUserProfileUseCase $getUserProfileUseCase,
        ApplyEventPlanUseCase $applyEventPlanUseCase,
        SendApplyPlanNotificationUseCase $sendApplyPlanNotificationUseCase
    ) {
        $userId = Auth::id();

        try {
            $user = $getUserProfileUseCase->interact(
                new GetUserProfileRequest($userId)
            )->getProfile();
        } catch (EntityNotFoundException $e) {
            return response(
                new UnauthorizedErrorResponse,
                403
            );
        }

        $result = $applyEventPlanUseCase->interact(
            new ApplyEventPlanRequest(
                $request->name,
                $user->getId(),
                $request->explanation
            )
        );
        $plan = $result->getPlan();

        $sendApplyPlanNotificationUseCase->interact(
            new SendApplyPlanNotificationRequest($plan, $user)
        );

        return new PlanResponse(
            $plan->getId(),
            $plan->getName(),
            new UserProfileResponse(
                $user->getId(),
                $user->getName(),
                new DiscordProfileResponse(
                    $user->getDiscord()->getId(),
                    $user->getDiscord()->getUsername(),
                    $user->getDiscord()->getDiscriminator()
                )
            ),
            $plan->getStatus(),
            $plan->getExplanation()
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
