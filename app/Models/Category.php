<?php

namespace App\Models;

use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

use App\Models\CategoryDiv;

class Category extends Model
{
    use ModelTree, AdminBuilder, CategoryDiv;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'left', 'right', 'depth', 'order', 'title', 'uri'
    ];

    static $divModel = 'App\Models\Category';
    static $divTable = "categories";
    static $divPrt = "parent_id";
    static $divLeft = "left";
    static $divRight = "right";
    static $divDepth = "depth";

    public function posts()
    {
    	return $this->hasMany('App\Models\Post', 'category_id');
    }
}