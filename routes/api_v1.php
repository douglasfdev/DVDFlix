<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    CustomerController,
    DvdController
};
use App\Services\RentDvdService;
use Pest\ArchPresets\Custom;

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/{user}', [CustomerController::class, 'show'])->name('customers.show');
        Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
        Route::patch('/{user}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    Route::prefix('dvds')->group(function () {
        Route::get('/', [DvdController::class, 'index'])->name('dvds.index');
        Route::get('{dvd}', [DvdController::class, 'show'])->name('dvds.show');
        Route::post('/', [DvdController::class, 'store'])->name('dvds.store');
        Route::patch('/{dvd}', [DvdController::class, 'update'])->name('dvds.update');
        Route::delete('/{dvd}', [DvdController::class, 'destroy'])->name('dvds.destroy');
    });

    Route::prefix('customers/{customer}/dvds')->group(function () {
        Route::post('/', [RentDvdService::class, 'rent'])->name('dvds.rent');
    });
});
