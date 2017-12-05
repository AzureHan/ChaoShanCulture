<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $category->getChildren(true, true))
            ->select('id','created_at','category_id','title','body_short')
            ->with([
                'images',
                'category',
            ])
            ->withCount('images')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get()
            ->transform(function($post) {

                $post->create_date = date(
                    'Y 年 m 月 d日',
                    strtotime($post->created_at)
                );

                return $post;
            });

            return $category;
        });

        // dd($categories);

        return view('index')
        ->with(compact('categories'));
    }
}
