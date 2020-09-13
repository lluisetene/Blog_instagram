<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\User;
use App\Comment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('image.uploadImg');
    }

    public function upload(Request $request, $user_id)
    {
        $request->validate([
            'image_path' => 'file|required|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:2048'
        ]);

        $image_path = $request->file('image_path');
        $image_path_name = time().$image_path->getClientOriginalName();
        Storage::disk('uploads')->put($image_path_name, File::get($image_path));

        $image = Image::create([
            'user_id' => $user_id,
            'description' => $request->get('description'),
            'image_path' => $image_path_name
        ]);

        /*Comment::create([
            'comment' => $request->get('comment'),
            'user_id' => $user_id,
            'image_id' => $image->id
        ]);*/

        return redirect()->route('user.show', ['id' => $user_id]);
    }

    public function showImage($filename)
    {
        $image = Image::where('image_path', $filename)->first();
        $user = User::where('id', $image->user_id)->first();
        return view('image.detail_img', [
            'image' => $image,
            'user' => $user
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('uploads')->get($filename);
        return new Response($file, 200);
    }

}
