<?php

namespace App\Services;
class RedisEventPusher implements EventPusher
{

    public function push(): string
    {
        return 'push';
    }

}
