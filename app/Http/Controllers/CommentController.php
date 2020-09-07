<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Image;
use App\User;

class CommentController extends Controller
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

    public function show($userId, $imgId)
    {
        $image = Image::find($imgId)->first();
        $user = User::find($userId)->first();
        return view('comment.show_comments', [
            'image' => $image,
            'user' => $user
        ]);
    }

    public function save(Request $request)
    {
        $toUserId = (int)$request->get('toUserId');
        $user = User::find($toUserId);
        if ($request->ajax()) {
            $fromUserId = (int)$request->get('fromUserId');
            $imageId = (int)$request->get('image_id');
            $commentUser = $request->get('comment-user');
            $commentId = Comment::create([
                            'user_id' => $fromUserId,
                            'toUser_id' => $toUserId,
                            'image_id' => $imageId,
                            'comment' => $commentUser
            ]);
            $image = Image::find($imageId);
            return view('image.detail_img', [
                'user' => $user,
                'image' => $image
            ])->renderSections();
            return response()->json([
                'comment-user' => $commentUser,
                'user' => $user,
                'image' => $image
            ]);
        } else {
            return view('image.detail_img', [
                'user' => $user
            ]);
        }
    }
}
