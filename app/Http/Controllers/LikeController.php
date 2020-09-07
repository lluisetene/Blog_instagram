<?php

namespace App\Http\Controllers;

use App\User;
use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $toUserId = (int)$request->get('toUserId');
        if ($request->ajax()) {
            $fromUserId = (int)$request->get('fromUserId');
            $funct = $request->get('funct');
            if ($funct == 'like-photo') {
                $imageId = (int)$request->get('image_id');
                Like::create([
                    'user_id' => $fromUserId,
                    'toUser_id' => $toUserId,
                    'image_id' => $imageId

                ]);
            } elseif ($funct == 'dislike-photo') {
                $imageId = (int)$request->get('image_id');
                $like = Like::where('user_id', $fromUserId)
                    ->where('toUser_id', $toUserId)
                    ->where('image_id', $imageId);
                $like->delete();
            } elseif ($funct == 'like-comment') {
                $commentId = (int)$request->get('comment_id');
                $imageId = (int)$request->get('image_id');
                Like::create([
                    'user_id' => $fromUserId,
                    'toUser_id' => $toUserId,
                    'image_id' => $imageId,
                    'comment_id' => $commentId
                ]);
            } elseif ($funct == 'dislike-comment') {
                $commentId = (int)$request->get('comment_id');
                $imageId = (int)$request->get('image_id');
                $like = Like::where('user_id', $fromUserId)
                    ->where('toUser_id', $toUserId)
                    ->where('image_id', $imageId)
                    ->where('comment_id', $commentId);
                $like->delete();
            }
        } else {
            return "";
        }
        return response()->json();
    }
}
