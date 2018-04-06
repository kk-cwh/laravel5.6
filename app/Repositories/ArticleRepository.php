<?php

namespace App\Repositories;

use App\Article;


class ArticleRepository
{
    use BaseRepository;

    protected  $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }
}