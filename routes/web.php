<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Filters\FilterController;
use App\Http\Controllers\Parser\ExcelUploadController;
use App\Http\Controllers\Parser\ImportsController;

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

Route::get('/datatable', function () {
    return view('datatable');
});

// User Area routes
Route::resource('users', UserController::class)->middleware('auth');

// Parser Area routes
Route::post('destroyRow/{row}', [ImportsController::class, 'destroyRow'])->middleware('auth')->name('imports.destroyRow');
Route::get('showRow/{row}', [ImportsController::class, 'showRow'])->middleware('auth')->name('imports.showRow');
Route::post('updateRow/{row}', [ImportsController::class, 'updateRow'])->middleware('auth')->name('imports.updateRow');
Route::get('/showSearchResult', [ImportsController::class, 'showSearchResult'])->middleware('auth')->name('imports.showSearchResult');
Route::resource('imports', ImportsController::class)->middleware('auth');
Route::post('excel-upload', ExcelUploadController::class)->middleware('auth')->name('excel-upload');

// Custom Filter routes