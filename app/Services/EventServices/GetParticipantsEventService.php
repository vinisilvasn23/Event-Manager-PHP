<?php

namespace App\Services\EventServices;

use App\Models\Enrollment;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetParticipantsEventService
{
    public function execute($id, array $data)
    {
        try {
            $event = Event::findOrFail($id);

            if ($event->user_id !== $data['user_id']) {
                return response()->json(['error' => 'Only the event owner can access this information.'], 403);
            }

            $participants = Enrollment::where('event_id', $id)
                ->join('users', 'enrollment.participant_id', '=', 'users.id')
                ->select('users.name', 'users.email')
                ->get();

            $participantsCount = $participants->count();

            return response()->json([
                'event' => [
                    'title' => $event->title,
                    'description' => $event->description
                ],
                'participants_count' => $participantsCount,
                'participants' => $participants
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
