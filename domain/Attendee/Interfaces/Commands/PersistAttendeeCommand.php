<?php

namespace Ome\Attendee\Interfaces\Commands;

use Ome\Attendee\Entities\Attendee;

interface PersistAttendeeCommand
{
    public function execute(Attendee $attendee): Attendee;
}
