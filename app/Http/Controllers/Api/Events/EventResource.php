<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\EventCreateRequest;
use App\Http\Requests\Api\Events\EventUpdateRequest;
use App\Http\Responses\Api\Events\EventResponse;
use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonRequest;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonUseCase;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventUseCase;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventRequest;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventUseCase;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusRequest;
use Ome\Event\Interfaces\UseCases\GetMarathonFromOengus\GetMarathonFromOengusUseCase;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventUseCase;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventRequest;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventUseCase;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventRequest;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventUseCase;
use Ome\Exceptions\EntityNotFoundException;

class EventResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        ListOengusEventUseCase $listOengusEvent
    ) {
        $events = $listOengusEvent->interact(
            new ListOengusEventRequest(Carbon::now())
        )->getEvents();
        usort($events, function (Event $a, Event $b) {
            return Carbon::make($a->getOengusMarathon()->getStartAt())->diffInSeconds(
                Carbon::make($b->getOengusMarathon()->getStartAt()),
                false
            );
        });

        $response = [];
        foreach ($events as $event) {
            $response[] = new EventResponse($event);
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        EventCreateRequest $request,
        GetMarathonFromOengusUseCase $getMarathonFromOengus,
        SaveOengusEventUseCase $saveOengusEvent
    ) {
        $marathon = $getMarathonFromOengus->interact(
            new GetMarathonFromOengusRequest($request->id)
        )->getOengusMarathon();

        $response = $saveOengusEvent->interact(
            new SaveOengusEventRequest($marathon, $request->relateType, $request->slug)
        );

        return new EventResponse($response->getEvent());
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(
        string $id,
        ExtractOengusEventUseCase $extractOengusEvent
    ) {
        try {
            $event = $extractOengusEvent->interact(
                new ExtractOengusEventRequest($id)
            )->getEvent();
        } catch (EntityNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return new EventResponse($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        EventUpdateRequest $request,
        string $id,
        ExtractOengusEventUseCase $extractOengusEvent,
        SaveOengusEventUseCase $saveOengusEvent
    ) {
        try {
            $event = $extractOengusEvent->interact(
                new ExtractOengusEventRequest($id)
            )->getEvent();
        } catch (EntityNotFoundException $e) {
            abort(404);
        }

        $saveOengusEvent->interact(
            new SaveOengusEventRequest(
                $event->getOengusMarathon(),
                $request->relateType,
                $request->slug
            )
        );

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        string $id,
        DetachOengusMarathonUseCase $detachOengusMarathon
    ) {
        $result = $detachOengusMarathon->interact(
            new DetachOengusMarathonRequest($id)
        );

        if (!$result) {
            abort(404);
        }
        return response()->noContent();
    }

    public function showLatest(
        FindLatestEventUseCase $findLatestEventUseCase
    ) {
        $latest = $findLatestEventUseCase->interact(
            new FindLatestEventRequest(Carbon::now())
        )->getEvent();

        if (is_null($latest)) {
            abort(404);
        }

        return new EventResponse($latest);
    }

    public function active(
        ListActiveOengusEventUseCase $listActiveOengusEvent
    ) {
        $events = $listActiveOengusEvent->interact(
            new ListActiveOengusEventRequest(Carbon::now())
        )->getEvents();
        usort($events, function (Event $a, Event $b) {
            return Carbon::make($a->getOengusMarathon()->getStartAt())->diffInSeconds(
                Carbon::make($b->getOengusMarathon()->getStartAt()),
                false
            );
        });

        $response = [];
        foreach ($events as $event) {
            $response[] = new EventResponse($event);
        }

        return $response;
    }
}
