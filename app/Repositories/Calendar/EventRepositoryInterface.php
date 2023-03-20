<?php namespace App\Repositories\Calendar;

interface EventRepositoryInterface
{
    public function getEvents($attributes);

    public function getClientEvents($attributes, $client);

    public function moveEvent($attributes, $event);
}
