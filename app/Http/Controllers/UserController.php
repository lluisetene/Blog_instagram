<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //return view('welcome');
        $user_list = User::all();
        return view('user.all_user_photos', [
            'user_list' => $user_list
        ]);
    }


    public function showProfile($id)
    {
        $user = User::where('id', $id)->first();
        if (is_null($user)) {
            return view('error.DataNotExist');
        }

        return view('user.profile', [
            'user' => $user,
            'images' => $user->images
        ]);
    }


    public function update($id)
    {
        $user = User::find($id);
        return view('user.update', [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'email' => $user->email,
            'image_path' => $user->image_path ?? '',
            'password' => $user->password
        ]);
    }


    public function save(Request $request, $id)
    {
        if (\Auth::user()) {

            $user = User::find($id);
            if (is_null($user)) {
                return view('error.DataNotExist');
            }

            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|unique:users|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'image_path' => 'file|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:2048'
            ]);

            $image_path = $request->file('image_path');

            $user->firstname = $request->get('firstname');
            $user->lastname = $request->get('lastname');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            if (!is_null($image_path)) {
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('users')->put($image_path_name, File::get($image_path));
                $user->image_path = $image_path_name;
            }

            $user->update();
            return redirect()->route('user.show', ['id' => $id])->with([
                'message' => 'Información actualizada correctamente'
            ]);
        }

    }

    public function getAvatar($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function usersList()
    {
        return User::inRandomOrder()->limit(5);;
    }


}
