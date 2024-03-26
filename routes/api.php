<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
|--------------------------------------------------------------------------
| CRUD USERS
|--------------------------------------------------------------------------
|
|
*/
Route::middleware('auth:api')->group(function () {
    // Route to show a specific user
    Route::get('/user/{id}', [UserController::class, 'show']);

    // Route to list all users
    Route::get('/users', [UserController::class, 'index']);

    // Route to create a new user
    Route::post('/users', [UserController::class, 'store']);

    // Route to update an existing user
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Route to delete an existing user
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
//Route::apiResource('users', UserController::class);

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
|
|
*/
Route::namespace('Api')->group(function (){

    Route::prefix('auth')->group(function (){
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::group([
        'middleware'=> 'auth:api'
    ],function (){
        Route::get('helloworld', [AuthController::class, 'index']);
        Route::post('logout',[AuthController::class,'logout']);
    });
});
