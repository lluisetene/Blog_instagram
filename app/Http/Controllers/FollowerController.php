<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;
use Illuminate\Http\Response;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $toUserId = (int)$request->get('toUserId');
        if ($request->ajax()) {
            $fromUserId = (int)$request->get('fromUserId');
            if ($request->get('funct') == 'follow') {
                Follower::create([
                    'user_id' => $fromUserId,
                    'toUser_id' => $toUserId
                ]);
                $msg = "Ahora le sigues!";
            } else {
                $user = Follower::where('user_id', $fromUserId)
                    ->where('toUser_id', $toUserId);
                $user->delete();
                $msg = 'Has dejado de seguirle!';
            }
        } else {
            $msg = "Ups, no puedes seguirlo!";
        }

        $user = User::find($toUserId);
        return response()->json([
            'followers' => count($user->followers),
            'followeds' => count($user->followeds),
            'msg' => $msg
        ]);
    }
}
