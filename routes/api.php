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

//api register,login,logout
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/get_users', [App\Http\Controllers\API\AuthController::class, 'get_users']);
    Route::post('/create', [App\Http\Controllers\API\AuthController::class, 'create']);
    Route::get('/delete/{id}', [App\Http\Controllers\API\AuthController::class, 'delete']);
    Route::get('/get_users_by_id/{id}', [App\Http\Controllers\API\AuthController::class, 'get_users_by_id']);
    Route::post('/update_user', [App\Http\Controllers\API\AuthController::class, 'update_user']);
    Route::get('/delete_user/{id}', [App\Http\Controllers\API\AuthController::class, 'deleteuser']);

    Route::get('/get_book', [App\Http\Controllers\API\BookController::class, 'index']);
    Route::post('/create_book', [App\Http\Controllers\API\BookController::class, 'create']);
    Route::post('/update_book/{id_buku}', [App\Http\Controllers\API\BookController::class, 'update']);
    Route::get('/delete_book/{id_buku}', [App\Http\Controllers\API\BookController::class, 'destroy']);
    Route::get('/get_by_id/{id_buku}', [App\Http\Controllers\API\BookController::class, 'get_by_id']);
});