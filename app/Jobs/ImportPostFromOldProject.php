<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Post;
use App\Models\PostImage;

const POSTS_TABLE_NAME = 'posts';
const OLD_POSTS_TABLE_NAME = 'cosa_document';
const POSTS_BODY_SHORT_LONG = 240;

class ImportPostFromOldProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $post;
    protected $originId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, $originId)
    {
        $this->post = $post;
        $this->originId = $originId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = Carbon::parse($this->post->created_at)
        ->format('ymd') . '/' . $this->originId . '.html';

        $content = Storage::disk('onetimes')
        ->get('import_documents/'. $path);

        preg_match_all(
            "|<img src=\"/Upload/image/(.*?)/(\d*?).(\w*?)\">|"
            , $content
            , $images
            , PREG_SET_ORDER
        );

        foreach($images as $image) {
            $oldPath = $image[1] . '/' . $image[2] . '.' . $image[3];
            $newPath = $image[1] . '/'. uniqid() . '.' . $image[3];

            if(Storage::disk('local')->exists('onetimes/import_images/'.$oldPath)) {
                Storage::disk('local')
                ->copy(
                    'onetimes/import_images/'.$oldPath,
                    'public/posts/images/'.$newPath                
                );

                $content = str_replace(
                    '/Upload/image/'.$oldPath,
                    asset('/storage/posts/images/'.$newPath),
                    $content
                );

                PostImage::create([
                    'post_id' => $this->post->id,
                    'uri' => $newPath,
                    'image_size' => filesize(
                        public_path('storage/posts/images/'.$newPath)
                    ),
                    'image_type' => pathinfo(
                        public_path('storage/posts/images/'.$newPath)
                        , PATHINFO_EXTENSION
                    ),
                ]);
            }
        }

        $short = html_entity_decode(mb_substr(
            strip_tags($content),
            0,
            POSTS_BODY_SHORT_LONG + 1
        ));
        $short = strlen($short) > POSTS_BODY_SHORT_LONG
        ? $short . ' ...' : $short;

        $this->post->update([
            'body' => $content,
            'body_short' => $short,
        ]);
    }
}
