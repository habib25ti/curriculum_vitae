<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\CVController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');

Route::get('question/response', [QuestionController::class, 'response'])->name('question.response');

Route::resource('pelanggan', PelangganController::class);

// Salin route berikut ke routes/web.php, jangan mengganti route yang sudah ada.
Route::resource('cv', CVController::class)->parameters(['cv' => 'cv']);
