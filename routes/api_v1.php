<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    CustomerController
};

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('customers')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customers.index');
        Route::get('{customer}', 'show')->name('customers.show');
        Route::post('/', 'store')->name('customers.store');
        Route::patch('/{customer}', 'update')->name('customers.update');
        Route::delete('/{customer}', 'destroy')->name('customers.destroy');
    });
});
