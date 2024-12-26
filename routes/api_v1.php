<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    CustomerController,
    DvdController,
    DashboardsController
};

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::middleware('throttle:search-users')->get('/{user}', [CustomerController::class, 'show'])->name('customers.show');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::patch('/{user}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{user}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

Route::prefix('dvds')->group(function () {
    Route::get('/', [DvdController::class, 'index'])->name('dvds.index');
    Route::get('{dvd}', [DvdController::class, 'show'])->name('dvds.show');
    Route::post('/', [DvdController::class, 'store'])->name('dvds.store');
    Route::post('/{dvd}', [DvdController::class, 'update'])->name('dvds.update');
    Route::patch('/{dvd}', [DvdController::class, 'update'])->name('dvds.update');
    Route::delete('{dvd}', [DvdController::class, 'destroy'])->name('dvds.destroy');
});

Route::prefix('customers/{user}/dvds/{dvd}')->group(function () {
    Route::post('/', [CustomerController::class, 'rentDvd'])->name('dvds.rent');
});

Route::prefix('dashboards')->group(function () {
    Route::get('/sellersComissions', [DashboardsController::class, 'sellersComissions'])->name('dashboards.index');
});
