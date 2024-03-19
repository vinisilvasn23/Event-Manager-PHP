<?php

namespace App\Services\EventServices;

use App\Models\Enrollment;
use App\Models\Event;
use App\Validators\EventValidator;

class CreateEventService
{
    public function execute(array $data)
    {

        $validator = EventValidator::validate($data);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $event = Event::create($data);

        $event->user()->associate($data['user_id'])->save();

        $enrollment = Enrollment::create([
            'event_id' => $event->id,
            'participant_id' => $data['user_id'],
        ]);

        return $event;
    }
}
