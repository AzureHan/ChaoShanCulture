<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoriesController extends Controller
{
	public function index()
	{
		$categories = (new Category())->toTree();

		return view(
			'categories.index',
			compact('categories')
		);
	}
}
