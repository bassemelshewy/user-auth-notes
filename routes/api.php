<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'user'], function () {
    Route::post('register',[AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
});

Route::group(['prefix' => 'notes'], function () {
    Route::get('/', [NotesController::class,'index']);
    Route::post('/', [NotesController::class,'store']);
    Route::get('{id}/show', [NotesController::class,'show']);
    Route::post('{id}/update', [NotesController::class,'update']);
    Route::delete('{id}/delete', [NotesController::class,'delete']);
});



