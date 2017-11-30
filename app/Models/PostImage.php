<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'uri', 'image_type', 'image_size'
    ];

    protected $table = 'post_images';

    protected $storePath = 'posts/images/';
}