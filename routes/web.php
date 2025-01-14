<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\GenerateController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

// Route::get('/Football', 'FootballController@index')->name('football');
Route::prefix('contactball')->group(function(){
    Route::get('/football', [FootballController::class, 'index'])->name('football.index');
    Route::get('/{id}/football', [FootballController::class, 'show'])->name('football.show');
});


Route::prefix('generate')->group(function(){
    Route::get('/artikel', [GenerateController::class, 'generateArtikel']);
    Route::get('/image', [GenerateController::class, 'generateImage']);
});