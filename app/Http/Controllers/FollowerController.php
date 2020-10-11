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
        list($fromUserId, $toUserId) = $this->getValues($request);
        Follower::create([
            'user_id' => $fromUserId,
            'toUser_id' => $toUserId
        ]);
        return response()->json(['msg' => "Ahora le sigues!",
                                 'funct' => 'follow',
                                 'url' => route('follow.unfollow')]);
    }


    public function unfollow(Request $request)
    {
        list($fromUserId, $toUserId) = $this->getValues($request);
        $user = Follower::where('user_id', $fromUserId)
            ->where('toUser_id', $toUserId);
        $user->delete();
        return response()->json(['msg' => 'Has dejado de seguirle!',
                                 'funct' => 'unfollow',
                                 'url' => route('follow.follow')]);
    }

    public function getValues($request)
    {
        if ($request->ajax()) {
            $toUserId = (int)$request->get('toUserId');
            $fromUserId = (int)$request->get('fromUserId');
            return [$fromUserId, $toUserId];
        } else {
            $msg = "Ups, no puedes seguirlo!";
            return response()->json(['msg' => $msg]);
        }
    }
}
