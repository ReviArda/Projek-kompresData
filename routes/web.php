<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileCompressionController;

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
});

Route::get('/', [FileCompressionController::class, 'index'])->name('home');
Route::post('/compress', [FileCompressionController::class, 'compress'])->name('compress');

Route::get('/about', function () {
    return view('compression.about');
})->name('about');

Route::get('/guide', function () {
    return view('compression.guide');
})->name('guide');
