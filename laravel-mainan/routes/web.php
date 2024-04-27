<?php

use App\Http\Controllers\MainanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/mainan/merah', [MainanController::class, 'mainanMerah']);
Route::get('/mainan/hijau-hitam', [MainanController::class, 'gantiHijau']);
Route::get('/mainan/urut', [MainanController::class, 'urutMainan']);
