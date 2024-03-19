<?php

namespace App\Services\EventServices;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetEventService
{
    public function execute($id = null)
    {
        try {
            if ($id === null) {
                return Event::all();
            }

            return Event::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
