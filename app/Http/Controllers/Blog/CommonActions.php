<?php


namespace App\Http\Controllers\Blog;


use App\Models\Post;
use App\Models\Rotation;
use Carbon\Carbon;

trait CommonActions
{
    /**
     * Author: chia2-y
     * Email: admin@chia2.com
     */
    public function rotaryMaps()
    {
        return Rotation::query()->where('status',Rotation::ENABLE)->get();
    }

    /**
     * Author: chia2-y
     * Email: admin@chia2.com
     */
    public function articleList(): \Illuminate\Contracts\Pagination\Paginator
    {
        return Post::query()->with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->where('is_draft', 0)
            ->orderBy('published_at', 'desc')
            ->simplePaginate(config('blog.posts_per_page'));
    }
}
