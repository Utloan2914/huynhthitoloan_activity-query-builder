<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }
    public function getOnePost($id)
    {
        $post = Post::find($id);
        return view('posts', ['post' => $post]);
    }
}
