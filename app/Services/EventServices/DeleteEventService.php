<?php

namespace App\Services\EventServices;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteEventService
{
    public function execute($id, array $data){
    try {
        $event = Event::findOrFail($id);

        if ($event->user_id !== $data['user_id']) {
            abort(403, 'Unauthorized');
        }

        $event->delete();

        return response()->json([], 204);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Event not found'], 404);
    }
}
}
