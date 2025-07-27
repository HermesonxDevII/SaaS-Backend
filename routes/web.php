<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    CompanyController,
    CompanyGroupController,
    CompanySegmentController,
    PriorityController,
    RegistrationController,
    ResponsibleTeamController,
    RoleController,
    SolicitationTypeController,
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

    Route::resource('/companies', CompanyController::class);
    Route::resource('/company-groups', CompanyGroupController::class);
    Route::resource('/company-segments', CompanySegmentController::class);
    Route::resource('/priorities', PriorityController::class);
    Route::resource('/registrations', RegistrationController::class);
    Route::resource('/responsible-teams', ResponsibleTeamController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/solicitation-types', SolicitationTypeController::class);
    Route::resource('/tickets', TicketController::class);
    Route::resource('/users', UserController::class);
});

require __DIR__.'/auth.php';
