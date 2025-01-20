<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\TopicController;
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

Route::prefix('contactball')->group(function(){
    Route::get('/football', [FootballController::class, 'index'])->name('football.index');
    Route::get('/viewall/football', [FootballController::class, 'viewAll'])->name('football.viewall');
    Route::get('/{id}/football', [FootballController::class, 'show'])->name('football.show');
    Route::get('/{id}/football/series', [FootballController::class, 'series'])->name('football.series');
});

// Topic
Route::prefix('topic')->group(function(){
    Route::get('/', [TopicController::class, 'index'])->name('topic.index');
    Route::get('create', [TopicController::class, 'create'])->name('topic.create');
    Route::get('/{id}/edit', [TopicController::class, 'edit'])->name('topic.edit');
    Route::get('/{id}/show', [TopicController::class, 'show'])->name('topic.show');
    Route::post('/', [TopicController::class, 'store'])->name('topic.store');
    Route::post('/{id}', [TopicController::class, 'update'])->name('topic.update');
    Route::delete('/{id}', [TopicController::class, 'destroy'])->name('topic.destroy');
});

Route::prefix('generate')->group(function(){
    Route::get('/artikel', [GenerateController::class, 'generateArtikel']);
    Route::get('/image', [GenerateController::class, 'generateImage']);
});