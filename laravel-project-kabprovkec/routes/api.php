<?php

use App\Http\Controllers\ControllerJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/project/json', [ControllerJson::class, 'JsonData']);
Route::get('/project/json/update-sum', [ControllerJson::class, 'JsonUpdateSUM']);
Route::get('/project/json/desa', [ControllerJson::class, 'JsonDataDesa']);
Route::get('/project/json/data-kab', [ControllerJson::class, 'JsonDataKab']);
