<?php

namespace App\Repositories;

use App\Article;


class LinkRepository
{
    use BaseRepository;

    protected  $model;

    public function __construct(Link $model)
    {
        $this->model = $model;
    }
}