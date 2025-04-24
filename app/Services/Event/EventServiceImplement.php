<?php

namespace App\Services\Event;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Event\EventRepository;
use Illuminate\Support\Facades\Storage;

class EventServiceImplement extends ServiceApi implements EventService
{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Event";
    protected $create_message = "successfully created";
    protected $update_message = "successfully updated";
    protected $delete_message = "successfully deleted";
    protected $search_message = "found";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getEvents()
    {
        try {
            return $this->eventRepository->getEvents();
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getEventbyId($eventId)
    {
        try {
            return $this->eventRepository->getEventbyId($eventId);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getEventbyRegion($eventRegion)
    {
        try {
            return $this->eventRepository->getEventbyRegion($eventRegion);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function createEvent($request)
    {
        try {
            $file =
                $request->has('event_poster')
                ? $this->uploadFile(
                    $request->file('event_poster'),
                    $request->event_title
                )
                : null;
            $eventData = [
                'event_poster' => $file,
                'event_title' => $request->event_title,
                'event_theme' => $request->event_theme,
                'event_link' => $request->event_link,
                'event_location' => $request->event_location,
                'event_region' => $request->event_region,
                'event_start_date' => $request->event_start_date,
                'event_end_date' => $request->event_end_date,
                'event_start_time' => $request->event_start_time,
                'event_end_time' => $request->event_end_time
            ];
            $result = $this->eventRepository->createEvent($eventData);
            return $this->setMessage(
                $this->title . " " . $this->create_message
            )
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updateEvent($request, $eventId)
    {
        try {
            $event = $this->getEventbyId($eventId);
            Storage::delete($event->event_poster);
            $file =
                $request->has('event_poster')
                ? $this->uploadFile($request->file('event_poster'), $request->event_title)
                : null;
            $eventData = [
                'event_poster' => $file,
                'event_title' => $request->event_title,
                'event_theme' => $request->event_theme,
                'event_link' => $request->event_link,
                'event_location' => $request->event_location,
                'event_region' => $request->event_region,
                'event_start_date' => $request->event_start_date,
                'event_end_date' => $request->event_end_date,
                'event_start_time' => $request->event_start_time,
                'event_end_time' => $request->event_end_time
            ];
            $result = $this->eventRepository->updateEvent($eventId, $eventData);
            return $this->setMessage($this->title . " " . $this->update_message)
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function uploadFile($data, $file_name)
    {
        $file_name = preg_replace('/\s+/', '', $file_name);
        $pattern = '/[@#$%^&*><`~()}{|":;?\/.,]/';
        $file_name = preg_replace($pattern, '', $file_name);
        $extension = $data->getClientOriginalExtension();
        $fileWithExtension = $file_name . "_" . (date("YmdHis", time())) . '.' . $extension;
        $path = $data->storeAs('/public/image/event', $fileWithExtension);
        $data->move(public_path() . '/storage/image/event', $fileWithExtension);
        return $path;
    }

    public function deleteEvent($eventId)
    {
        try {
            $event = $this->getEventbyId($eventId);
            Storage::delete($event->event_poster);
            $this->eventRepository->deleteEvent($eventId);
            return $this->setMessage($this->title . " " . $this->delete_message)
                ->setStatus(true)
                ->setCode(200);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function searchEvent($request)
    {
        try{
            $result = $request->input('search');
            $searchResult = $this->eventRepository->searchEvent($result);
            return $this->setMessage($this->search_message)->setStatus(true)->setCode(200)->setResult($searchResult);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function countEvent()
    {
        try{
            $count = $this->eventRepository->countEvent();
            return $this->setStatus(true)->setCode(200)->setResult($count);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

}
