<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    CustomerController,
    DvdController
};

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('customers')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customers.index');
        Route::get('{customer}', 'show')->name('customers.show');
        Route::post('/', 'store')->name('customers.store');
        Route::patch('/{customer}', 'update')->name('customers.update');
        Route::delete('/{customer}', 'destroy')->name('customers.destroy');
    });

    Route::prefix('dvds')->controller(DvdController::class)->group(function () {
        Route::get('/', 'index')->name('dvds.index');
        Route::get('{dvd}', 'show')->name('dvds.show');
        Route::post('/', 'store')->name('dvds.store');
        Route::patch('/{dvd}', 'update')->name('dvds.update');
        Route::delete('/{dvd}', 'destroy')->name('dvds.destroy');
    });
});
