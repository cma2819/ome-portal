<?php

namespace App\Http\Controllers\Api\Schemes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Schemes\SchemeStatusUpdateRequest;
use Carbon\Carbon;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusRequest;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusUseCase;
use Ome\Exceptions\EntityNotFoundException;

class UpdateSchemeStatus extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SchemeStatusUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        int $id,
        SchemeStatusUpdateRequest $request,
        ProceedEventSchemeStatusUseCase $proceedEventSchemeStatus
    ) {
        try {
            $proceedEventSchemeStatus->interact(
                new ProceedEventSchemeStatusRequest(
                    $id,
                    $request->status,
                    $request->reply,
                    Carbon::now()
                )
            );
        } catch (EntityNotFoundException $e) {
            abort(404);
        }

        return response()->noContent();
    }
}
