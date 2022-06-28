<?php

use App\Http\Controllers\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware(['auth:sanctum', 'ability:is_admin']);


Route::get('provinces',[\App\Http\Controllers\Api\V1\AddressController::class,'getProvincesIR']);
Route::get('provinces/{province}',[\App\Http\Controllers\Api\V1\AddressController::class,'getProvince']);
Route::get('provinces/{province}/cities',[\App\Http\Controllers\Api\V1\AddressController::class,'getProvinceCities']);


Route::prefix('v1')->group(function(){

    Route::middleware('auth:sanctum')->group(function (){

        Route::middleware(['auth:sanctum', 'ability:is_admin'])->group(function (){

        });
        Route::middleware(['auth:sanctum', 'ability:is_repairman , is_admin'])->group(function (){

        });
    });


});


