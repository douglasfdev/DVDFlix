<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect('/home'));

Route::get('/home', fn () => Inertia::render('Dvds'))->name('home');

Route::get('/dvds', fn () => Inertia::render('Dvds'))->name('dvds');

Route::get('/dashboard', fn () => Inertia::render('Dashboards', [
    'display' => 'flex',
    'flexDirection' => 'row',
    'gap' =>  '10px',
    'height' => '500px'
]))->name('dashboard');

Route::get('/customers', fn () => Inertia::render('Users'))->name('customers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
