<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function create(Request $request)
    {

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->desc = $request->desc;

        //check if post has photo
        if($request->photo != '') {
            //choose a unique name for photo
            $photo = time().'jgp';
            \file_put_contents('storage/posts'.$photo,\base64_decode($request->photo));
            $post->photo = $photo;

        }

        $post->save();
        $post->user;
        return response()->json([
            'success' => true,
            'message' => 'posted',
            'post' => $post
        ]);

    }
}
