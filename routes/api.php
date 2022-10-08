<?php

use App\Http\Controllers\Api\StageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\API\AuthController;

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

//Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->prefix(LaravelLocalization::setLocale())->group(function () {
//    Route::get('/stages', [StageController::class, "index"]);
//    Route::get('/stage/{id}', [StageController::class, "show"]);
//    Route::post('/stages', [StageController::class, "store"]);
//});


Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(StageController::class)->group(function () {
        Route::get('/stages', "index");
        Route::get('/stage/{id}', "show");
        Route::post('/stages', "store");
        Route::put('/stage/{id}', "update");
        Route::delete('/stage/{id}', "destroy");
    });
    Route::post('logout', [AuthController::class,'logout']);

});
