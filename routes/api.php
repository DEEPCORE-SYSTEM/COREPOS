<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;


// Ruta protegida para obtener el usuario autenticado
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// 🔥 Agrega estas rutas para la autenticación OAuth2 con Passport
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])
    ->middleware(['throttle']);

Route::get('/oauth/authorize', [AuthorizationController::class, 'authorize'])
    ->middleware(['auth']);


