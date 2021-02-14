<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\AttendeeCreateRequest;
use App\Http\Requests\Api\Events\AttendeeIndexRequest;
use App\Http\Requests\Api\Events\AttendeeUpdateRequest;
use App\Http\Responses\Api\Events\AttendeeResponse;
use App\Infrastructure\Eloquents\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventRequest;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventUseCase;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventRequest;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventUseCase;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventUseCase;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventRequest;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventUseCase;
use Ome\Exceptions\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AttendeeResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @param AttendeeIndexRequest
     * @return \Illuminate\Http\Response
     */
    public function index(
        string $id,
        AttendeeIndexRequest $request,
        ListAttendeesInEventUseCase $listAttendeesInEvent
    ) {
        $attendees = $listAttendeesInEvent->interact(
            new ListAttendeesInEventRequest(
                $id,
                $request->scope
            )
        )->getAttendees();
        usort($attendees, function (AttendeeDto $a, AttendeeDto $b) {
            return $a->getUser()->getId() - $b->getUser()->getId();
        });

        $response = [];
        foreach ($attendees as $attendeeDto) {
            $response[] = new AttendeeResponse($attendeeDto);
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $event
     * @param  AttendeeCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        string $event,
        AttendeeCreateRequest $request,
        RegisterAttendeeForEventUseCase $registerAttendeeForEvent
    ) {
        try {
            $attendee = $registerAttendeeForEvent->interact(
                new RegisterAttendeeForEventRequest(
                    $event,
                    $request->id,
                    $request->scopes
                )
            )->getAttendee();
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return new AttendeeResponse($attendee);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(
        string $eventId,
        int $userId,
        FindAttendeeInEventUseCase $findAttendeeInEvent
    ) {
        /** @var User */
        $loginUser = Auth::user();
        if (!($loginUser->can('access-to-admin')) && ($loginUser->id !== $userId)) {
            throw new AuthorizationException();
        }

        $attendee = $findAttendeeInEvent->interact(
            new FindAttendeeInEventRequest($eventId, $userId)
        )->getAttendee();

        if (is_null($attendee)) {
            abort(404);
        }

        return new AttendeeResponse($attendee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttendeeUpdateRequest $request
     * @param string $eventId
     * @param integer $userId
     * @return \Illuminate\Http\Response
     */
    public function update(
        AttendeeUpdateRequest $request,
        string $eventId,
        int $userId,
        FindAttendeeInEventUseCase $findAttendeeInEvent,
        RegisterAttendeeForEventUseCase $registerAttendeeForEvent
    ) {
        $attendee = $findAttendeeInEvent->interact(
            new FindAttendeeInEventRequest($eventId, $userId)
        )->getAttendee();

        if (is_null($attendee)) {
            abort(404);
        }

        $registerAttendeeForEvent->interact(
            new RegisterAttendeeForEventRequest(
                $attendee->getAttendee()->getEventId(),
                $attendee->getAttendee()->getUserId(),
                $request->scopes
            )
        );

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        string $eventId,
        int $userId,
        DetachAttendeeFromEventUseCase $detachAttendeeFromEvent
    ) {
        $result = $detachAttendeeFromEvent->interact(
            new DetachAttendeeFromEventRequest($userId, $eventId)
        )->getResult();

        if (!$result) {
            abort(404);
        }

        return response()->noContent();
    }
}
