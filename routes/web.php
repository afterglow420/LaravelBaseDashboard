<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ArticleController;

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

Route::get('/dashboard', function () {
    return view('datatable');
});

//Article Resources & Routes
Route::resource('articles', ArticleController::class);

Route::post('uploadFromTinyMCE', [ArticleController::class, 'uploadFromTinyMCE'])->name('uploadFromTinyMCE');
Route::post('uploadFeatured', [ArticleController::class, 'uploadFeatured'])->name('uploadFeatured');
Route::get('deleteFeaturedPhoto', [ArticleController::class, 'deleteFeaturedPhoto'])->name('deleteFeaturedPhoto');

//Media Resources & Routes
Route::resource('medias', MediaController::class);

// Text Editor upload route
// Route::post('articles/upload', [ArticleController::class, 'upload'])->name('articles.upload');

// Logs Resources & Routes
Route::get('logs', [LogController::class, 'index'])->name('logs');