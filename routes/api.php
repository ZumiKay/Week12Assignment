<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register' , [\App\Http\Controllers\AuthController::class , 'Register']);
Route::post('login' , [\App\Http\Controllers\AuthController::class , 'Login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[\App\Http\Controllers\AuthController::class , 'Logout']);
    Route::post('create-items',[\App\Http\Controllers\ToDoController::class , 'create']);
    Route::post('edit-items' , [\App\Http\Controllers\ToDoController::class, 'edititems']);
    Route::post('delete-items' , [\App\Http\Controllers\ToDoController::class , 'delete']);
    Route::get('getpublicitems' , [\App\Http\Controllers\ToDoController::class, 'getpublicItems']);
    Route::post('getprivateitems' , [\App\Http\Controllers\ToDoController::class , 'getprivateItems']);
});
