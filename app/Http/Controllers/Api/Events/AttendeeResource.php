<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\AttendeeIndexRequest;
use App\Http\Responses\Api\Events\AttendeeResponse;
use Illuminate\Http\Request;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventUseCase;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
