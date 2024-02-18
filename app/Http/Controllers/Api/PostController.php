<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'   => ['required', 'string', 'max:200'],
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $post = $request->user()->posts()->create($validate);

        return response()->json([
            'post' => $post->id
        ]);
    }
}
