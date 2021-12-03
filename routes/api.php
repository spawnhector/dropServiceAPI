<?php

use App\Http\Controllers\API\Admin\adminController;
use App\Http\Controllers\API\User\userController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:member-api')->group(function() {
    Route::group(['prefix' => 'member'], function() {
        Route::get('/', function() {
            return response()->json(request()->user());
        });

        Route::post('/update', [userController::class,'updateProgress']);
        Route::post('/generatetempaddress',[userController::class,'generateTempAddress']);
        Route::group(['prefix' => 'prealert'], function() {
            Route::post('/',[userController::class,'preAlert']);
            Route::post('/create',[userController::class,'createPreAlert']);
            Route::post('/update',[userController::class,'updatePreAlert']);
            Route::delete('/delete/{id}',[userController::class,'deletePreAlert']);
        });

        Route::get('/slide', [userController::class,'getSlide']);
        Route::post('/enableslide', [userController::class,'enableSlide']);
        Route::post('/disableslide', [userController::class,'disableSlide']);
        Route::get('/activity', [userController::class,'activity']);
        Route::post('/logout', [userController::class,'logout']);
    });
});

Route::middleware('auth:admin-api')->group(function() {
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', function() {
            return response()->json(request()->user());
        });
    });
});

Route::post('register',[userController::class,'register']);
Route::post('login',[userController::class,'login']);
Route::post('adminlogin',[adminController::class,'login']);