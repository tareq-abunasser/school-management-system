<?php

use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Stages\StageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
}
);
Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->prefix(LaravelLocalization::setLocale())->group(function () {

    Route::middleware(['auth'])->group(function () {

//        -------------------------------------------------------------------------
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

//        -------------------------------------------------------------------------


        Route::resource('stages', StageController::class);

//        -------------------------------------------------------------------------
        Route::delete('stages/delete-all',[GradeController::class, 'deleteAll'])->name('delete-all');
        Route::post('stages/filter',[GradeController::class, 'filterGrade'])->name('filter');
        Route::resource('grades', GradeController::class);

        //        -------------------------------------------------------------------------

    }
    );

});


//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
