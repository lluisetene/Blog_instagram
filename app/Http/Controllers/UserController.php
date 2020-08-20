<?php

namespace App\Http\Controllers;

use App\User;
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

//            $validate = $this->validate($request, [
//                'fisrtname' => 'required',
//                'lastname' => 'required',
//                'username' => 'required',
//                'email' => 'required',
//                'image_path' => 'image'
//            ]);
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $username = $request->get('username');
            $email = $request->get('email');
            $image_path = $request->file('image_path');

            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->username = $username;
            $user->email = $email;
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


}
