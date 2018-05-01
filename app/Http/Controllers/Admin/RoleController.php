<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;


class RoleController extends ApiController
{
    private $roleRepository ;

    /**
     * RoleController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * 查询角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $number = $request->input('number',10);
        $data = $this->roleRepository->pageToArray($number);
        return  $this->successResponse($data);
    }


    /**
     * 新增角色信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->only(['name','description','status']);
        $data = $this->roleRepository->store($inputs);
        return $this->successResponse($data);
    }

    /**修改编辑角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $inputs = $request->only('name','description','status');
        $data = $this->roleRepository->update($id,$inputs);
        return $this->successResponse($data);

    }

    /**
     * 删除角色信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $data = $this->roleRepository->destroy($id);
        return $this->successResponse($data);
    }
}
