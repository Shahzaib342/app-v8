<?php

namespace App\Services;

interface Messenger
{
    public function sendMessage(string $recipient, string $message): string;
}


