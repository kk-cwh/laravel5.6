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


    /**
     * 二级菜单
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function menuTree(){
        return $this->model->with('children')->where('parent_id',0)->get();
    }
}