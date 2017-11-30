<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{
	public function show($id)
	{
		$post = Post::find($id);

		return view('posts.show')
		->with(compact('post'));
	}
}
