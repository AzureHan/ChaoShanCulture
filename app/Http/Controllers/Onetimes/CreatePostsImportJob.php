<?php

namespace App\Http\Controllers\Onetimes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Jobs\ImportPostFromOldProject;

const POSTS_TABLE_NAME = 'posts';
const OLD_POSTS_TABLE_NAME = 'cosa_document';

class CreatePostsImportJob extends Controller
{
    public function index()
    {
    	$posterId = Auth('admin')->user()->id;

    	$rawData = DB::table(OLD_POSTS_TABLE_NAME)
    	->select('id','docname','cateid','createtime')
    	->orderBy('createtime')
    	->get()
    	->each(function($row) use($posterId) {
            $postModel = new Post();
            $postModel->title = $row->docname;
            $postModel->category_id = $row->cateid;
            $postModel->poster_id = $posterId;
            $postModel->body = '';
            $postModel->published = true;
            $postModel->created_at = $row->createtime;
            $postModel->updated_at = $row->createtime;
            $postModel->save();
    	
            ImportPostFromOldProject::dispatch($postModel, $row->id);
    	});

        dd('Done');
    }

    public function down()
    {
        
    }
}
