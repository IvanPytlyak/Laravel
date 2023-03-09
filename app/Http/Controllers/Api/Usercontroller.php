<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return 'message from user:' . $request->query('attribute');
    }

    public function view(Request $request)
    {
        return 'User (ID):' . $request->route('id');
    }

    public function viewComment(Request $request)
    {
        $id = $request->route('id');
        $order_id = $request->route('order_id');
        $comment_id = $request->route('comment_id');
        $user = User::find($id); // user::all();
        $order = Order::find($order_id); // DB::connection('mydb')->table('orders')->where('id', $order_id)->first();
        $comment = DB::connection('mydb')->table('comments')->where('id', $comment_id)->first();
        if ($user && $order && $comment) {
            return "ID: $user->id, Имя: $user->name, Фамилия: $user->surname, Заказ: $order->product, Комментарий: $comment->comment";
        } else {
            return "Такой заказ не существует";
        }
    }
}
