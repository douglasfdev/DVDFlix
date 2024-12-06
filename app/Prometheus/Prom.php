<?php

namespace App\Prometheus;

use Prometheus\CollectorRegistry;
use Illuminate\Support\Facades\Facade;

class Prom extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CollectorRegistry::class;
    }
}
