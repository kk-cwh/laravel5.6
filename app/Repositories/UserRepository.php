<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    use BaseRepository;

    protected  $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}