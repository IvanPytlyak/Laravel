<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hello-world', function () {
    return ('Привет мир');
});


Route::get('/users/{id}', function ($id) {
    $user = DB::connection('mydb')->table('users')->where('id', $id)->first();
    if ($user) {
        return "ID: $user->id, Имя: $user->name, Фамилия: $user->surname";
    } else {
        return "Пользователь с таким ID не найден";
    }
})->where('id', '\d+'); //->whereNumber('id')


Route::get('/users/{id}/orders/{order_id}/comments/{comment_id}', function ($id, $order_id, $comment_id) {
    $user = DB::connection('mydb')->table('users')->where('id', $id)->first();
    $order = DB::connection('mydb')->table('orders')->where('id', $order_id)->first();
    $comment = DB::connection('mydb')->table('comments')->where('id', $comment_id)->first();
    if ($user && $order && $comment) {
        return "ID: $user->id, Имя: $user->name, Фамилия: $user->surname, Заказ: $order->product, Комментарий: $comment->comment";
    } else {
        return "Такой заказ не существует";
    }
})->where('id', '\d+')->where('order_id', '\d+')->where('comment_id', '\d+');
