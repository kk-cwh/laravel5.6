<?php
/**
 * Created by PhpStorm.
 * User: jaak
 * Date: 2018/5/1
 * Time: 10:59
 */

namespace App\Repositories;


use App\Models\Menu;

class MenuRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
}