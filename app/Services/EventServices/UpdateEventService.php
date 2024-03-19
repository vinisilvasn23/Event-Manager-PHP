<?php

namespace App\Services\EventServices;

use App\Models\Event;
use App\Validators\EventValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateEventService
{
    public function execute($id, array $data)
    {
        try {
            $event = Event::findOrFail($id);

            if ($event->user_id !== $data['user_id']) {
                abort(403, 'Unauthorized');
            }
            $validator = EventValidator::validate($data, true);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $event->update($data);

            return response()->json($event);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
