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

class CommentController extends Controller
{
    // получение вкомментария по id
    public function viewComment(Request $request)
    {
        $id = $request->route('id');
        $myCommentId = Comment::find($id);
        if ($myCommentId) {
            $commentList[] =
                [
                    'comment' => "$myCommentId->comment",
                ];

            return response()->json($commentList, 200);
        } else {
            return response()->json([
                'error' => "Комменарий с таким ID отсутствует",
            ], 404);
        }
    }
}
