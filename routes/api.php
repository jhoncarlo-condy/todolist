<?php

use App\Http\Controllers\TodoListController;
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



Route::get('/items',[TodoListController::class, 'index']);

Route::prefix('item')->group(function () {
    Route::post('/store',[TodoListController::class, 'store']);
    Route::put('/update/{id}',[TodoListController::class, 'update']);
    Route::delete('/delete/{id}',[TodoListController::class, 'delete']);
});
