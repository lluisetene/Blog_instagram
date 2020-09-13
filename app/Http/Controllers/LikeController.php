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


    public function likeImg($fromUserId, $toUserId, $imageId)
    {
        Like::create([
            'user_id' => $fromUserId,
            'toUser_id' => $toUserId,
            'image_id' => $imageId
        ]);
    }


    public function dislikeImg($fromUserId, $toUserId, $imageId)
    {
        $like = Like::where('user_id', $fromUserId)
                    ->where('toUser_id', $toUserId)
                    ->where('image_id', $imageId);
        $like->delete();
    }


    public function likeComment($fromUserId, $toUserId, $imageId, $commentId)
    {
        Like::create([
            'user_id' => $fromUserId,
            'toUser_id' => $toUserId,
            'image_id' => $imageId,
            'comment_id' => $commentId
        ]);
    }


    public function dislikeComment($fromUserId, $toUserId, $imageId, $commentId)
    {
        $like = Like::where('user_id', $fromUserId)
            ->where('toUser_id', $toUserId)
            ->where('image_id', $imageId)
            ->where('comment_id', $commentId);
        $like->delete();
    }


    public function index(Request $request)
    {
        $toUserId = (int)$request->get('toUserId');
        if ($request->ajax()) {
            $fromUserId = (int)$request->get('fromUserId');
            $imageId = (int)$request->get('image_id');
            list($funct, $dest) = explode('_', $request->get('funct'));
            if ($dest == 'img') {
                if ($funct == 'like') {
                    $this->likeImg($fromUserId, $toUserId, $imageId);
                } else {
                    $this->dislikeImg($fromUserId, $toUserId, $imageId);
                }
            } elseif ($dest == 'comment') {
                $commentId = (int)$request->get('comment_id');
                if ($funct == 'like') {
                    $this->likeComment($fromUserId, $toUserId, $imageId, $commentId);
                } else {
                    $this->dislikeComment($fromUserId, $toUserId, $imageId, $commentId);
                }
            }
//            if ($funct == 'like-img') {
//                $imageId = (int)$request->get('image_id');
//                Like::create([
//                    'user_id' => $fromUserId,
//                    'toUser_id' => $toUserId,
//                    'image_id' => $imageId
//
//                ]);
//            } elseif ($funct == 'dislike-img') {
//                $imageId = (int)$request->get('image_id');
//                $like = Like::where('user_id', $fromUserId)
//                    ->where('toUser_id', $toUserId)
//                    ->where('image_id', $imageId);
//                $like->delete();
//            } elseif ($funct == 'like-comment') {
//                $commentId = (int)$request->get('comment_id');
//                $imageId = (int)$request->get('image_id');
//                Like::create([
//                    'user_id' => $fromUserId,
//                    'toUser_id' => $toUserId,
//                    'image_id' => $imageId,
//                    'comment_id' => $commentId
//                ]);
//            } elseif ($funct == 'dislike-comment') {
//                $commentId = (int)$request->get('comment_id');
//                $imageId = (int)$request->get('image_id');
//                $like = Like::where('user_id', $fromUserId)
//                    ->where('toUser_id', $toUserId)
//                    ->where('image_id', $imageId)
//                    ->where('comment_id', $commentId);
//                $like->delete();
//            }
        } else {
            return "";
        }
        return response()->json();
    }
}
