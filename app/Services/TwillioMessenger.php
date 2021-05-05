<?php

namespace App\Services;

class TwillioMessenger implements Messenger
{
    public function sendMessage(string $recipient, string $message): string
    {
        return 'Sending message from twillio';
    }
}


