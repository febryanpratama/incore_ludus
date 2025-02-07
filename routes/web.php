<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\BadmintonController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\VolleyController;
use App\Http\Controllers\MartialArtsController;
use App\Http\Controllers\SilatController;
use App\Http\Controllers\KarateController;
use App\Http\Controllers\TaekwondoController;
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

Route::prefix('football')->group(function(){
    Route::get('/', [FootballController::class, 'index'])->name('football.index');
    Route::get('/viewall/football', [FootballController::class, 'viewAll'])->name('football.viewall');
    Route::get('/viewhighlight/football', [FootballController::class, 'viewHighlight'])->name('football.viewhighlight');
    Route::get('/{id}/football', [FootballController::class, 'show'])->name('football.show');
    Route::get('/{id}/football/series', [FootballController::class, 'series'])->name('football.series');
});

Route::prefix('basket')->group(function(){
    Route::get('/', [BasketController::class, 'index'])->name('basket.index');
    Route::get('/viewall/basket', [BasketController::class, 'viewAll'])->name('basket.viewall');
    Route::get('/viewhighlight/basket', [BasketController::class, 'viewHighlight'])->name('basket.viewhighlight');
    Route::get('/{id}/basket', [BasketController::class, 'show'])->name('basket.show');
    Route::get('/{id}/basket/series', [BasketController::class, 'series'])->name('basket.series');
});
Route::prefix('badminton')->group(function(){
    Route::get('/', [BadmintonController::class, 'index'])->name('badminton.index');
    Route::get('/viewall/badminton', [BadmintonController::class, 'viewAll'])->name('badminton.viewall');
    Route::get('/viewhighlight/badminton', [BadmintonController::class, 'viewHighlight'])->name('badminton.viewhighlight');
    Route::get('/{id}/badminton', [BadmintonController::class, 'show'])->name('badminton.show');
    Route::get('/{id}/badminton/series', [BadmintonController::class, 'series'])->name('badminton.series');
});
Route::prefix('volley')->group(function(){
    Route::get('/', [VolleyController::class, 'index'])->name('volley.index');
    Route::get('/viewall/volley', [VolleyController::class, 'viewAll'])->name('volley.viewall');
    Route::get('/viewhighlight/volley', [VolleyController::class, 'viewHighlight'])->name('volley.viewhighlight');
    Route::get('/{id}/volley', [VolleyController::class, 'show'])->name('volley.show');
    Route::get('/{id}/volley/series', [VolleyController::class, 'series'])->name('volley.series');
});
Route::prefix('materialarts')->group(function(){
    Route::get('/', [MaterialArtsController::class, 'index'])->name('materialarts.index');
    Route::get('/viewall/materialarts', [MaterialArtsController::class, 'viewAll'])->name('materialarts.viewall');
    Route::get('/viewhighlight/materialarts', [MaterialArtsController::class, 'viewHighlight'])->name('materialarts.viewhighlight');
    Route::get('/{id}/materialarts', [MaterialArtsController::class, 'show'])->name('materialarts.show');
    Route::get('/{id}/materialarts/series', [MaterialArtsController::class, 'series'])->name('materialarts.series');
});
Route::prefix('pencaksilat')->group(function(){
    Route::get('/', [SilatController::class, 'index'])->name('silat.index');
    Route::get('/viewall/silat', [SilatController::class, 'viewAll'])->name('silat.viewall');
    Route::get('/viewhighlight/silat', [SilatController::class, 'viewHighlight'])->name('silat.viewhighlight');
    Route::get('/{id}/silat', [SilatController::class, 'show'])->name('silat.show');
    Route::get('/{id}/silat/series', [SilatController::class, 'series'])->name('silat.series');
});
Route::prefix('karate')->group(function(){
    Route::get('/', [KarateController::class, 'index'])->name('karate.index');
    Route::get('/viewall/karate', [KarateController::class, 'viewAll'])->name('karate.viewall');
    Route::get('/viewhighlight/karate', [KarateController::class, 'viewHighlight'])->name('karate.viewhighlight');
    Route::get('/{id}/karate', [KarateController::class, 'show'])->name('karate.show');
    Route::get('/{id}/karate/series', [KarateController::class, 'series'])->name('karate.series');
});
Route::prefix('taekwondo')->group(function(){
    Route::get('/', [TaekwondoController::class, 'index'])->name('taekwondo.index');
    Route::get('/viewall/taekwondo', [TaekwondoController::class, 'viewAll'])->name('taekwondo.viewall');
    Route::get('/viewhighlight/taekwondo', [TaekwondoController::class, 'viewHighlight'])->name('taekwondo.viewhighlight');
    Route::get('/{id}/taekwondo', [TaekwondoController::class, 'show'])->name('taekwondo.show');
    Route::get('/{id}/taekwondo/series', [TaekwondoController::class, 'series'])->name('taekwondo.series');
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