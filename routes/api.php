<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ExternalApiController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('get-jokes', [ExternalApiController::class, 'getJokes']);