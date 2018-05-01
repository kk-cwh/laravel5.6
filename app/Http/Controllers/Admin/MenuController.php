<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends ApiController
{
    private $menuRepository ;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * 菜单查询
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $number = $request->input('number',10);
        $data = $this->menuRepository->pageToArray($number);
        return  $this->successResponse($data);
    }

    /**
     * 保存菜单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->only(['title','name','description','status']);
        $data = $this->menuRepository->store($inputs);
        return $this->successResponse($data);
    }

    /**
     * 修改编辑菜单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $inputs = $request->only(['title','name','description','status']);
        $data = $this->menuRepository->update($id,$inputs);
        return $this->successResponse($data);

    }

    /**
     * 删除菜单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $data = $this->menuRepository->destroy($id);
        return $this->successResponse($data);
    }
}
