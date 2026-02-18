<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\CsvApiController;

Route::get('/', [CsvController::class, 'index'])->name('csv.index');
Route::post('/csv/upload', [CsvController::class, 'upload'])->name('csv.upload');
Route::get('/csv/downloadLatestRecord/{format?}', [CsvController::class, 'downloadLatestRecord'])->name('csv.latest-download');
//API
Route::prefix('api')->group(function () {
    Route::get('/csv/count', [CsvApiController::class, 'count'])->name('csv.count');
    Route::get('/csv/{id}', [CsvApiController::class, 'getById'])->name('csv.getById');
    Route::get('/csv/list/{page_size}/{offset}', [CsvApiController::class, 'list'])->name('csv.list');
});