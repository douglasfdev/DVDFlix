<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('dvd:price-strategy')->everyThreeMinutes();
Schedule::command('prometheus:sum-all-sellers-comission')->everyTenMinutes();
