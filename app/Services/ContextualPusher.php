<?php

namespace App\Services;
class ContextualPusher implements EventPusher
{

    public function push(): string
    {
        return 'push from contextual class';
    }

}
