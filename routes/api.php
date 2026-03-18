<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SessionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/game',[GameController::class,'store']);
Route::get('/games',[GameController::class,'index']);
Route::put('/game/{id}',[GameController::class,'update']);
Route::delete('/game/{id}',[GameController::class,'destroy']);

Route::post('/player',[PlayerController::class,'store']);
Route::get('/players',[PlayerController::class,'index']);

Route::post('/session',[SessionController::class,'store']);
Route::get('/sessions',[SessionController::class,'index']);
Route::put('/session/{id}',[SessionController::class,'update']);
Route::delete('/session/{id}',[SessionController::class,'destroy']);
