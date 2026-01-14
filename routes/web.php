<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminTrainingSessionController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/trainers', function () {
    return view('trainers');
});


Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas de cliente autenticado
Route::middleware([Authenticate::class])->group(function () {

    // Dashboard principal del cliente
    Route::get('/dashboard', [ClientController::class, 'dashboard'])
        ->name('dashboard');

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Reservas de sesiones
    Route::post('/sessions/{session}/reserve', [ClientController::class, 'reserve'])
        ->name('sessions.reserve');

    //Mis sesiones reservadas
    Route::get('/sessions', [ClientController::class, 'mySessions'])
        ->name('sessions');
    Route::get('/sessions/calendar', [ClientController::class, 'annualCalendar'])
        ->name('sessions.calendar');

    Route::delete('/sessions/{session}/cancel', [ClientController::class, 'cancel'])
        ->name('sessions.cancel');

    // Historial completo de sesiones
    Route::get('/sessions/history', [ClientController::class, 'allMySessions'])
        ->name('sessions.history');
});

// Rutas de administración protegidas por rol 'admin'
Route::middleware([Authenticate::class, RoleMiddleware::class . ':admin'])
    ->group(function () {
        Route::resource('training', AdminTrainingSessionController::class)
            ->parameters(['training' => 'session']);
    });

// Rutas rol entrenador
Route::middleware([RoleMiddleware::class . ':coach'])->group(function () {
    Route::get('/coach/sessions', [CoachController::class, 'weeklySessions'])
        ->name('coach.coach-sessions');
});



require __DIR__ . '/auth.php';
