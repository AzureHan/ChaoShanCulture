<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poster_id', 'title', 'body', 'published'
    ];

    public function poster()
    {
    	return $this->belongsTo('Encore\Admin\Auth\Database\Administrator', 'poster_id', 'id');
    }
}