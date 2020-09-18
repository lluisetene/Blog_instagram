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
                $msg = $this->follow($fromUserId, $toUserId);
            } else {
                $msg = $this->unfollow($fromUserId, $toUserId);
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


    public function follow(Request $request)
    {
        list($fromUserId, $toUserId) = getValues($request);
        Follower::create([
            'user_id' => $fromUserId,
            'toUser_id' => $toUserId
        ]);
        return "Ahora le sigues!";
    }


    public function unfollow($fromUserId, $toUserId)
    {
        $user = Follower::where('user_id', $fromUserId)
            ->where('toUser_id', $toUserId);
        $user->delete();
        return 'Has dejado de seguirle!';
    }

    public function getValues($request)
    {
        if ($request->ajax()) {
            $toUserId = (int)$request->get('toUserId');
            $fromUserId = (int)$request->get('fromUserId');
            return [$toUserId, $fromUserId];
        } else {
            $msg = "Ups, no puedes seguirlo!";
            response()->json([
                'msg' => $msg]);
        }
    }
}
