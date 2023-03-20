<?php namespace App\Repositories\Calendar;

use App\Models\Event;
use App\Repositories\BaseRepository;
use DateTime;

//CMS

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    protected $model;

    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function getEvents($attributes, $user_id = null)
    {
        return Event::whereDate('start', '>=', date('Y-m-d', strtotime($attributes['start'])))
            ->whereDate('start', '<=', date('Y-m-d', strtotime($attributes['end'])))
            ->when($user_id, function($query) use ($user_id) {
                $query->where("user_id", $user_id);
            })
            ->get(['id', 'client_id', 'user_id', 'name', 'start', 'end', 'allday', 'time', 'type', 'note', 'active']);
    }

    public function getClientEvents($attributes, $client = null)
    {
        return Event::whereDate('start', '>=', date('Y-m-d', strtotime($attributes['start'])))
            ->whereDate('start', '<=', date('Y-m-d', strtotime($attributes['end'])))
            ->when($client, function($query) use ($client) {
                $query->where("client_id", $client->id);
            })
            ->when($attributes['user_id'], function($query) use ($attributes) {
                $query->where("user_id", $attributes['user_id']);
            })
            ->when($user_id = auth()->id(), function($query) use ($user_id) {
                $query->where("user_id", $user_id);
            })
            ->get(['id', 'client_id', 'name', 'start', 'end', 'allday', 'time', 'type', 'note', 'active']);
    }

    public function moveEvent($attributes, $event): array
    {
        $createDate = new DateTime($attributes['date']);
        $allDay = $attributes['allday'] == "true" ? 1 : 0;
        $event->preventAttrSet = true;

        $event->update([
            'allday' => $allDay,
            'start' => $createDate->format('Y-m-d'),
            'time' => ($allDay) ? NULL : $createDate->format('H:i')
        ]);
        return ['success' => true, 'allday' => $allDay];
    }
}
