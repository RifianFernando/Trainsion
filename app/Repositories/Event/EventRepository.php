<?php

namespace App\Repositories\Event;

use LaravelEasyRepository\Repository;

interface EventRepository extends Repository{

    public function getEvents();
    public function getEventbyId($eventId);
    public function getEventbyRegion($eventR);
    public function createEvent($request);
    public function updateEvent($request, $eventId);
    public function deleteEvent($eventId);
    public function searchEvent($result);
    public function countEvent();

}
