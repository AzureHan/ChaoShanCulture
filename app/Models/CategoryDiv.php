<?php

namespace App\Models;

use DB;

use App\Models\Category;

trait CategoryDiv
{
	/**
	 * Refresh categories divs
	 */
	public static function refreshDivs()
	{
		// Values after refresh
		$categories = collect([]);

		// Values from database
		DB::table(self::$divTable)
		->select('id','parent_id')
		->orderBy('parent_id') // Just promise root node is the first
		->get()
		->each(function($cateRaw) use($categories) {

			// If this category is root node
			if($cateRaw->parent_id == 0) {

				$leftMin = $categories
				->where('parent_id', 0)->min(self::$divLeft);

				$rightMax = $categories
				->where('parent_id', 0)->max(self::$divRight);

				$cateRaw->left = 1;
				$cateRaw->right = 2;
				// $cateRaw->depth = 0;

				// Not the first one node
				if($leftMin > 0) {
					$cateRaw->left += $rightMax;
					$cateRaw->right += $rightMax;
				}

				$categories->push($cateRaw);

			// If this category is not root node
			} else {

				// Get it's parent node
				$cateParent = $categories
				->where('id', $cateRaw->parent_id)
				->first();

				$cateRaw->left = $cateParent->right;
				$cateRaw->right = $cateParent->right + 1;

				// Offset categories divs for different root node
				$categories->where(self::$divLeft, '>', $cateParent->right)
				->transform(function($cate) {
					$cate->left = $cate->left + 2;
					$cate->right = $cate->right + 2;
					return $cate;
				});

				// Offset categories divs in same root node
				$categories->where(self::$divLeft, '<', $cateParent->left)
				->where(self::$divRight, '>', $cateParent->right)
				->transform(function($cate) {
					$cate->right = $cate->right + 2;
					return $cate;
				});

				// Offset parent categories divs
				$categories->where('id', $cateParent->id)
				->transform(function($cate) {
					$cate->right = $cate->right + 2;
					return $cate;
				});

				$categories->push($cateRaw);
			}
		});

		// Update database
		$categories->each(function($category) {
			DB::table(self::$divTable)
			->where('id', $category->id)
			->update([
				self::$divLeft => $category->left,
				self::$divRight => $category->right,
			]);
		});
	}

	/**
	 * Query root categories
	 */
	public static function roots() 
	{
		return Category::where(self::$divPrt, 0);
	}

	public function getChildren($andSelf = true, $idWonder = false)
	{
		$categoriesId = DB::table(self::$divTable)
		->select('id')
		->whereBetween(
			self::$divLeft,
			[$this->{self::$divLeft}, $this->{self::$divRight}]
		)
		->orderBy(self::$divLeft)
		->get()
		->pluck('id')
		->all();

		if($andSelf === false) {
			array_shift($categoriesId);
		}

		if($idWonder === true) {
			return $categoriesId;
		} else {
			return ('\\'.self::$divModel)::find($categoriesId);
		}
	}
}