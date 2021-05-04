<?php

namespace App\Services;
class Pusher
{
    public function __construct(\App\Services\EventPusher $eventPusher)
    {
        $this->eventPusher = $eventPusher;
    }

    public function index()
    {
        return $this->eventPusher->push();
    }

}
