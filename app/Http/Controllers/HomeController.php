<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends ApiController
{
    //  文章类别
    public function types()
    {
        $types = Category::all(['id', 'name']);
        return $this->successResponse(compact('types'));
    }

    // 文章标签
    public function tags()
    {
        $tags = Tag::withCount('articles')->get(['id', 'name']);
        return $this->successResponse(compact('tags'));
    }

    // 文章
    public function articles(Request $request)
    {
        $tagId = $request->input('tag_id');

        $query = Article::with(['category', 'tags']);
        if ($tagId) {
            $query->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tags.id', $tagId);
            });
        }
        $data = $query->orderBy('id', 'DESC')->paginate()->toArray();

        $articles['total']        = array_get($data, 'total');
        $articles['current_page'] = array_get($data, 'current_page');
        $articles['last_page']    = array_get($data, 'last_page');
        $articles['list']         = array_get($data, 'data');
        return $this->successResponse(compact('articles'));
    }


    public function articleDetail($id)
    {
        $article = Article::with(['type', 'tags'])->find($id);

        return $this->successResponse(compact('article'));
    }

    public function archives(Request $request)
    {
        $tagId = $request->input('tag_id');
        $query = Article::with(['category', 'tags']);
        if ($tagId) {
            $query->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tags.id', $tagId);
            });
        }
        $data                     = $query->select(DB::raw("id,type_id,title,created_at,DATE_FORMAT(`created_at`,'%M,%Y') as archives"))->orderBy('id', 'DESC')->paginate()->toArray();
        $articles['total']        = array_get($data, 'total');
        $articles['current_page'] = array_get($data, 'current_page');
        $articles['last_page']    = array_get($data, 'last_page');
        $articles['list']         = collect(array_get($data, 'data'))->groupBy('archives');
        return $this->successResponse(compact('articles'));
    }
}
