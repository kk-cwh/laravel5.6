<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticleController extends ApiController
{
    protected $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * 文章详情
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        $article = Article::with('type','tags')->where('id', $id)->first();

        return $this->successResponse($article);
    }

    /**
     * 文章列表
     * @return mixed
     * @internal param $id
     */
    public function index()
    {
        $data  = $this->articleRepository->pageToArray();
        return $this->successResponse($data);
    }


    /**
     * 更新文章是否显示在前台
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = $this->articleRepository->getById($id);
        $isShow  = array_get($article, 'is_show') == 1 ? 0 : 1;
        $this->articleRepository->update($id, ['is_show', $isShow]);
        return $this->successResponse();
    }

//  发布文章

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs  = $request->all();

        $inputs['user_id'] = $request->user()->id;

        $article = $this->articleRepository->store($inputs);
        if(array_get($inputs,'tagIds')){
            $tagIds = array_unique(array_get($inputs,'tagIds'));
            $tmps = [];
            foreach ($tagIds as $tagId) {
                $tmps[] = ['article_id'=>$article->id,'tag_id'=>$tagId];
            }

            DB::table('tag_articles')->insert($tmps);
        }

        return $this->successResponse($article);
    }


//  修改文章
    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $article = $this->articleRepository->getById($id);

        if ($article) {

            $result = $this->articleRepository->update($id, $inputs);

            if ($result) {
                return $this->successResponse();
            }

        } else {
            return $this->errorResponse('参数有误');
        }
        return $this->errorResponse('系统繁忙',500);
    }
}
