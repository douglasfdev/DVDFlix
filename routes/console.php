<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:dvd-price-strategy')->everyThreeMinutes();
