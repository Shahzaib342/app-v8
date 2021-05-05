<?php

namespace App\Services;

class Decorator implements Messenger
{
    public $messages;

    public function __construct(Messenger ...$messenger)
    {
        $this->messages = $messenger;
    }

    public function sendMessage(string $recipient, string $message): string
    {
        return 'Sending message from decorator service';
    }
}


