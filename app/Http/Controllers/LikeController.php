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


    /**
     * Función que recibe la petición y comprueba que
     *
     * @param $request: pasamos los parámetros de la petición
     * @return int[]|string
     */
    public function getValues($request)
    {
        if ($request->ajax()) {
            if ($request->get('user')) {
                $request = $request->get('user');
            }
            $fromUserId = (int)$request->get('fromUserId');
            $toUserId = (int)$request->get('toUserId');
            $imageId = (int)$request->get('image_id');
            $commentId = (int)$request->get('comment_id');
            return [$fromUserId, $toUserId, $imageId, $commentId];
        } else {
            return '';
        }

    }


    public function likeImg(Request $request)
    {
        if (count($this->getValues($request)) > 0) {
            list($fromUserId, $toUserId, $imageId) = $this->getValues($request);
            Like::create([
                'user_id' => $fromUserId,
                'toUser_id' => $toUserId,
                'image_id' => $imageId
            ]);
            return response()->json();
        } else {
            return '';
        }
    }


    public function dislikeImg(Request $request)
    {
        if (count($this->getValues($request)) > 0) {
            list($fromUserId, $toUserId, $imageId) = $this->getValues($request);
            $like = Like::where('user_id', $fromUserId)
                        ->where('toUser_id', $toUserId)
                        ->where('image_id', $imageId);
            $like->delete();
            return response()->json();
        } else {
            return '';
        }
    }


    public function likeComment(Request $request)
    {
        if (count($this->getValues($request)) > 0) {
            list($fromUserId, $toUserId, $imageId, $commentId) = $this->getValues($request);
            Like::create([
                'user_id' => $fromUserId,
                'toUser_id' => $toUserId,
                'image_id' => $imageId,
                'comment_id' => $commentId
            ]);
            return response()->json();
        } else {
            return '';
        }
    }


    public function dislikeComment(Request $request)
    {
        if (count($this->getValues($request)) > 0) {
            list($fromUserId, $toUserId, $imageId, $commentId) = $this->getValues($request);
            $like = Like::where('user_id', $fromUserId)
                ->where('toUser_id', $toUserId)
                ->where('image_id', $imageId)
                ->where('comment_id', $commentId);
            $like->delete();
            return response()->json();
        } else {
            return '';
        }
    }
}
