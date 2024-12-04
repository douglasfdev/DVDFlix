<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    CustomerController
};

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    });
});
