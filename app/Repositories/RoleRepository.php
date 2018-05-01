<?php
/**
 * Created by PhpStorm.
 * User: jaak
 * Date: 2018/5/1
 * Time: 10:52
 */

namespace App\Repositories;


use App\Models\Role;

class RoleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}