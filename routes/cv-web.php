<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;

// Salin route berikut ke routes/web.php, jangan mengganti route yang sudah ada.
Route::resource('cv', CVController::class)->parameters(['cv' => 'cv']);
