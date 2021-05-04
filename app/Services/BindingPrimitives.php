<?php

namespace App\Services;
class BindingPrimitives
{
    public function __construct($var)
    {
        $this->var = $var;
    }

    public function index()
    {
        return $this->var;
    }
}
