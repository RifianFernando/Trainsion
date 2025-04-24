<?php

namespace App\Services\Event;

use LaravelEasyRepository\BaseService;

interface EventService extends BaseService{

    public function getEvents();
    public function getEventbyId($eventId);
    public function getEventbyRegion($eventRegion);
    public function createEvent($request);
    public function updateEvent($request, $eventId);
    public function deleteEvent($eventId);
    public function searchEvent($request);
    public function countEvent();

}
