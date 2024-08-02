<?php

use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('register/check', [RegisteredUserController::class, 'check'])->name('api-register-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{province_id}', [LocationController::class, 'regencies'])->name('api-regencies');