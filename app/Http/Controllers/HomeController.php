<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =
        Category::where('parent_id', 0)
        ->orderBy('order')
        ->get()
        ->transform(function($category) {
            $category->posts = 
            Post::whereIn( 'category_id',
                $category->getChildren(true, false))
            ->select('id','category_id','title')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

            return $category;
        });

        // dd($categories);

        return view('index')
        ->with(compact('categories'));
    }
}
