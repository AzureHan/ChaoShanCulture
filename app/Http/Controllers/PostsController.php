<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{
	public function show($id)
	{
		$post = Post::find($id);

		return view('posts.show')
		->with(compact('post'));
	}

	public function category($id)
	{
		
	}
}
