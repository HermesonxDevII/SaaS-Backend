<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    RegistrationController,
    TicketController,
    UserController
};

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
        - Rotas do ::resource

        - Route::get('/', [Controller::class, 'index'])->name('tickets.index');
        - Route::get('/create', [Controller::class, 'create'])->name('tickets.create');
        - Route::post('/', [Controller::class, 'store'])->name('tickets.store');
        - Route::get('/{model}', [Controller::class, 'show'])->name('tickets.show');
        - Route::get('/{model}/edit', [Controller::Class, 'edit'])->name('tickets.edit');
        - Route::put('/{model}', [Controller::class, 'update'])->name('tickets.update');
        - Route::delete('/{model}', [Controller::Class, 'destroy'])->name('tickets.destroy');
    */

    Route::resource('registrations', RegistrationController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
