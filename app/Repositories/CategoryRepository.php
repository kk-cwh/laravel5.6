<?php

namespace App\Repositories;

use App\Category;


class CategoryRepository
{
    use BaseRepository;

    protected  $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}