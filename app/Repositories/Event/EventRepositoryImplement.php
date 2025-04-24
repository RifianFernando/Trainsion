<?php

namespace App\Repositories\Event;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventRepositoryImplement extends Eloquent implements EventRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getEvents()
    {
        $data = $this->event->all();
        foreach($data as $key => $value){
            $photo = $value->event_poster;
            $data[$key]->event_poster =
                $value->event_poster
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $data;
    }

    public function getEventbyId($eventId)
    {
        return $this->event->findOrFail($eventId);
    }

    public function getEventbyRegion($eventRegion)
    {
        return $this->event->where('event_region', $eventRegion)->get();
    }

    public function createEvent($eventData)
    {
        return $this->event->create($eventData);
    }

    public function updateEvent($eventId, $eventData)
    {
        return $this->event->findOrFail($eventId)->update($eventData);
    }

    public function deleteEvent($eventId)
    {
        return $this->event->destroy($eventId);
    }

    public function searchEvent($result)
    {
        return $this->event->where('event_title', 'like', '%' . $result . '%')->get();
    }

    public function countEvent(): int
    {
        $countEvent = DB::table('events')->count();
        return $countEvent;
    }

}
