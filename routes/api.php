<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\RoleController;
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
| CRUD Roles
|--------------------------------------------------------------------------
|
|
*/
Route::middleware('auth:api')->group(function () {
    // Route to show a specific role
    Route::get('/role/{id}', [RoleController::class, 'show']);

    // Route to list all roles
    Route::get('/roles', [RoleController::class, 'index']);

    // Route to create a new role
    Route::post('/roles', [RoleController::class, 'store']);

    // Route to update an existing role
    Route::put('/roles/{id}', [RoleController::class, 'update']);

    // Route to delete an existing role
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
|
|
*/
Route::namespace('Api')->group(function (){


    /*
    |--------------------------------------------------------------------------
    | Forgot-password
    |--------------------------------------------------------------------------
    */
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
    Route::get('/mot-de-passe/reinitialiser/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/mot-de-passe/reset/', [AuthController::class, 'reset']);

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


