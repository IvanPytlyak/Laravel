<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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




Route::get('/user', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'view'])->where('id', '[0-9]+');

Route::get('/users/{id}/orders/{order_id}/comments/{comment_id}', [UserController::class, 'viewComment'])
    ->where([
        'id' => '\d+',
        'order_id' => '\d+',
        'comment_id' => '\d+'
    ]);
