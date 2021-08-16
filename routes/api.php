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

// Get currently logged in user data
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// COnfirm if user is authenticated or not. Used in conjunction with 
Route::middleware('auth:sanctum')->get('/authenticated', function (Request $request) {
    return true;
});

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);

Route::get('/form/index', [App\Http\Controllers\FormController::class, 'index']);
Route::post('/form/store', [App\Http\Controllers\FormController::class, 'store']);
Route::get('/form/show/{id}', [App\Http\Controllers\FormController::class, 'show']);
Route::patch('/form/update/{id}', [App\Http\Controllers\FormController::class, 'update']);
Route::delete('/form/destroy/{id}', [App\Http\Controllers\FormController::class, 'destroy']);