<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    function getList()
    {
        $news = News::query()->where('is_published', true)
            ->where('published_at', '<=', 'NOW()')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(5);

        return view('news_list', ['news' => $news]);
    }

    function getDetails($slug)
    {
        $news_item = News::query()
            ->where('slug', $slug)
            ->where('published_at', '<=', 'NOW()')
            ->where('is_published', true)
            ->first();

        if ($news_item === null) {
            abort(404);
        }
        return view('news', ['item' => $news_item]);
    }
}
