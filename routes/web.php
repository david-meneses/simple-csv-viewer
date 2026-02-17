<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/', [CsvController::class, 'index'])->name('csv.index');
Route::post('/csv/upload', [CsvController::class, 'upload'])->name('csv.upload');
Route::get('/csv/downloadLatestRecord/{format?}', [CsvController::class, 'downloadLatestRecord'])->name('csv.latest-download');
//API
Route::prefix('api')->group(function () {
    Route::get('/csv/count', [CsvApiController::class, 'count'])->name('csv.count');
});