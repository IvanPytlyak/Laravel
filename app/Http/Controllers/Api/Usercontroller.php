<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    public function index(Request $request) // поручает данные из GET-запроса
    {
        return 'message from user:' . $request->query('attribute');
    }

    public function view(Request $request)
    {
        return 'User (ID):' . $request->route('id'); // получает ID
    }

    public function viewComment(Request $request) // вполучение всех заказов и коментариев
    {
        $id = $request->route('id');
        $order_id = $request->route('order_id');
        $comment_id = $request->route('comment_id');
        $user = User::find($id); // user::all();
        $order = Order::find($order_id); // DB::connection('mydb')->table('orders')->where('id', $order_id)->first();
        $comment = Comment::find($comment_id);
        if ($user && $order && $comment) {
            return "ID: $user->id, Имя: $user->name, Фамилия: $user->surname, Заказ: $order->product, Комментарий: $comment->comment";
        } else {
            return "Такой заказ не существует";
        }
    }


    // получение всех заказов пользователя
    public function viewOrder(Request $request)
    {
        $id = $request->route('id');
        $user = User::find($id);
        if ($user) {
            $orders = $user->orders;
            if ($orders->isNotEmpty()) {
                // $ordeList = $orders->pluck('product')->implode(', '); // pluck достает product  // 
                foreach ($orders as $order) {
                    $ordeList[] =
                        [
                            'user_id' => "$user->id",
                            'product' => "$order->product",
                        ];
                }
                return response()->json($ordeList, 200);
            } else {
                return response()->json([
                    'error' => "У пользвателя с ID: $user->id нет заказов",
                ], 404);
            }
        } else {
            return response()->json([
                'error' => "Пользвателя с таким ID нет существует",
            ], 404);
        }
    }
}
