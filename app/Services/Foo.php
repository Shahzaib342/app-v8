<?php

namespace App\Services;
class Foo
{
    public function __construct($appName)
    {
        $this->appName = $appName;
    }

    public function hello()
    {
        return $this->appName;
    }

}
