<?php

use App\Http\Controllers\User\UserEditTaskController;
use App\Models\User;
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

Route::group(["prefix" => "/user"], function (){
    Route::post("/{user}/task", [UserEditTaskController::class, "add"]);
    Route::post("/task/{task}", [UserEditTaskController::class, "confirmation"]);
});
