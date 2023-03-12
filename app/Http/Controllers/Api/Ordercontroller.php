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

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return 'message from user:' . $request->query('attribute');
    }

    public function view(Request $request)
    {
        return 'User (ID):' . $request->route('id');
    }




    // получение заказа по id
    public function viewOrder(Request $request)
    {
        $id = $request->route('id');
        $myOrderId = Order::find($id);
        if ($myOrderId) {
            $ordeList[] =
                [
                    'product' => "$myOrderId->product",
                ];

            return response()->json($ordeList, 200);
        } else {
            return response()->json([
                'error' => "Заказ с  таким ID отсутствует",
            ], 404);
        }
    }
}
