<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Services\Event\EventService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    public function getEvents(){
        return $this->eventService->getEvents();
    }

    public function getEventbyId($eventId){
        return $this->eventService->getEventbyId($eventId);
    }

    public function getEventbyRegion($eventRegion){
        return $this->eventService->getEventbyRegion($eventRegion);
    }

    public function createEvent(Request $request) : JsonResponse{
        return $this->eventService->createEvent($request)->toJson();
    }

    public function updateEvent(Request $request, $eventId) : JsonResponse{
        return $this->eventService->updateEvent($request, $eventId)->toJson();
    }

    public function deleteEvent($eventId) : JsonResponse{
        return $this->eventService->deleteEvent($eventId)->toJson();
    }

    public function searchEvent(Request $request) : JsonResponse {
        return $this->eventService->searchEvent($request)->toJson();
    }

    public function countEvent() : JsonResponse{
        return $this->eventService->countEvent()->toJson();
    }

}
