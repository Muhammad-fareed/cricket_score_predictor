<?php

use App\Http\Controllers\PredictionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PredictionController::class,'showForm'])->name('predict-cricket-score-form');
Route::post('/predict-cricket-score', [PredictionController::class,'predictCricketScore'])->name('predict-cricket-score');
