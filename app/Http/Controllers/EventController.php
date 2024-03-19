<?php

namespace App\Http\Controllers;

use App\Services\EventServices\CreateEventService;
use App\Services\EventServices\DeleteEventService;
use App\Services\EventServices\EnrollUserEventService;
use App\Services\EventServices\GetEventService;
use App\Services\EventServices\GetParticipantsEventService;
use App\Services\EventServices\UpdateEventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $createEventService;
    protected $getEventService;
    protected $updateEventService;
    protected $deleteEventService;
    protected $enrollUserEventService;
    protected $getParticipantsEventService;

    public function __construct(
        CreateEventService $createEventService,
        GetEventService $getEventService,
        UpdateEventService $updateEventService,
        DeleteEventService $deleteEventService,
        EnrollUserEventService $enrollUserEventService,
        GetParticipantsEventService $getParticipantsEventService
    ) {
        $this->createEventService = $createEventService;
        $this->getEventService = $getEventService;
        $this->updateEventService = $updateEventService;
        $this->deleteEventService = $deleteEventService;
        $this->enrollUserEventService = $enrollUserEventService;
        $this->getParticipantsEventService = $getParticipantsEventService;

    }

    public function create(Request $request)
    {
        return $this->createEventService->execute($request->all());
    }
    public function getEvent()
    {
        return $this->getEventService->execute();
    }

    public function updateEvent(Request $request, $id)
    {
        return $this->updateEventService->execute($id, $request->all());
    }

    public function deleteEvent(Request $request, $id)
    {
        return $this->deleteEventService->execute($id, $request->all());
    }

    public function getEventById($id)
    {
        return $this->getEventService->execute($id);
    }
    public function enrollUser(Request $request, $id)
    {
        return $this->enrollUserEventService->execute($id, $request->all());
    }
    public function getEventParticipants(Request $request, $id)
    {
        return $this->getParticipantsEventService->execute($id, $request->all());
    }
}
