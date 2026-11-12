<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SolicitudController;

Route::get('/', function () {
    return view('portada');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/recuperar-contrasena', function () {
    return view('auth.recuperar');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    // Redirige al panel que corresponde según el rol.
    Route::get('/dashboard', function () {
        return redirect(Auth::user()->rol === 'tecnico' ? '/tecnico' : '/solicitante');
    })->name('dashboard');

    // Rutas para solicitantes
    Route::middleware('role:solicitante')->group(function () {
        Route::get('/solicitante', [PanelController::class, 'dashboard']);
        Route::get('/solicitante/solicitudes', [PanelController::class, 'lista']);
        Route::get('/solicitante/nueva', [PanelController::class, 'nueva']);

        Route::post('/solicitudes', [SolicitudController::class, 'store']);
    });

    // Rutas para técnicos
    Route::middleware('role:tecnico')->group(function () {
        Route::get('/tecnico', [PanelController::class, 'dashboard']);
        Route::get('/tecnico/solicitudes', [PanelController::class, 'lista']);

        Route::patch('/solicitudes/{id}', [SolicitudController::class, 'update']);
    });

    // Rutas compartidas por ambos roles
    Route::get('/solicitudes/{id}', [SolicitudController::class, 'show']);

    Route::get('/perfil', [PanelController::class, 'perfil']);
    Route::put('/perfil/password', [PanelController::class, 'cambiarPassword']);

});
