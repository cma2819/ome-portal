<?php

namespace App\Infrastructure\Commands\Attendee;

use App\Infrastructure\Eloquents\EventAttendee;
use Illuminate\Support\Facades\DB;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Commands\PersistAttendeeCommand;

class DbPersistAttendeeCommand implements PersistAttendeeCommand
{
    public function execute(Attendee $attendee): Attendee
    {
        $attendeeScopes = [];
        foreach ($attendee->getScopes() as $scope) {
            $attendeeScopes[] = $scope->value();
        }

        DB::transaction(function () use ($attendee, $attendeeScopes) {
            EventAttendee::query()
                ->where('event_id', '=', $attendee->getEventId())
                ->where('user_id', '=', $attendee->getUserId())
                ->whereNotIn('attend_scope', $attendeeScopes)
                ->delete();

            foreach ($attendeeScopes as $scope) {
                EventAttendee::insertOrIgnore([
                    'event_id' => $attendee->getEventId(),
                    'user_id' => $attendee->getUserId(),
                    'attend_scope' => $scope,
                ]);
            }
        });

        return $attendee;
    }
}
