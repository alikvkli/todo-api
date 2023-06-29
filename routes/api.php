<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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


Route::prefix("v1")->group(function(){
    Route::post("/auth", [UserController::class, 'auth']);
    Route::get("/todos", [TodoController::class, 'index']);
    Route::post("/add", [TodoController::class,'create']);
    Route::patch("/update/{id}", [TodoController::class, 'edit']);
    Route::delete("/delete/{id}", [TodoController::class, 'destroy']);
});