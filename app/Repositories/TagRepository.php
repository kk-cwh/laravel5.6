<?php

namespace App\Repositories;

use App\Tag;


class TagRepository
{
    use BaseRepository;

    protected  $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}