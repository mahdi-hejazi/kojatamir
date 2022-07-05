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
        Route::post('/address/add_address',[\App\Http\Controllers\Api\V1\AddressController::class,'addAddressToUser']);
        Route::get('/address/get_addresses',[\App\Http\Controllers\Api\V1\AddressController::class,'getAddresses']);
        Route::post('/repairman/add_repairman_info',[\App\Http\Controllers\Api\V1\RepairmanController::class,'addRepairmanInfo']);
        Route::get('/repairman/getRepairmanInfo',[\App\Http\Controllers\Api\V1\RepairmanController::class,'getRepairmanInfo']);
        Route::get('/repairmen',[\App\Http\Controllers\Api\V1\RepairmanController::class,'index']);




    });
    Route::prefix('admin')->middleware( ['auth:sanctum','ability:is_admin'])->group(function (){
        Route::get('/user',[\App\Http\Controllers\Api\V1\Admin\UserController::class,'index']);
        Route::get('/user/{id}',[\App\Http\Controllers\Api\V1\Admin\UserController::class,'show']);
        Route::delete('/user/{id}',[\App\Http\Controllers\Api\V1\Admin\UserController::class,'destroy']);

        Route::get('repairman/get_repairmen_requests',[\App\Http\Controllers\Api\V1\Admin\RepairmanController::class,'getRepairmenRequests']);
        Route::post('repairman/set_is_repairman',[\App\Http\Controllers\Api\V1\Admin\RepairmanController::class,'setIsRepairman']);

//        Route::resource('repairman',\App\Http\Controllers\Api\V1\Admin\RepairmanController::class);
        Route::resource('repair_service',\App\Http\Controllers\Api\V1\Admin\RepairServiceController::class)->except('create','edit','show','update','destroy');
    });
    Route::middleware( ['auth:sanctum','ability:is_repairman , is_admin'])->group(function (){
        Route::post('/repairmen/addLicense',[\App\Http\Controllers\Api\V1\RepairmanController::class,'addLicense']);
    });


});


