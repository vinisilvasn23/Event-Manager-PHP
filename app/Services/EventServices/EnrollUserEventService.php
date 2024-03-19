<?php

namespace App\Services\EventServices;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Response;

class EnrollUserEventService
{
    public function execute($id, array $data)
    {
        try {
            $event = Event::findOrFail($id);

            Enrollment::create([
                'event_id' => $event->id,
                'participant_id' => $data['user_id'],
            ]);

            return Response::json(['message' => 'Successfully enrolled in the event.'], 200);

        } catch (ModelNotFoundException $e) {
            return Response::json(['error' => 'Event not found'], 404);
        }
    }
}
