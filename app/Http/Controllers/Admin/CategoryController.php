<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;


class CategoryController extends ApiController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function  index(){
       $data =  $this->categoryRepository->pageToArray();
       return $this->apiResponse($data);
    }

    public function store(Request $request)
    {
        $inputs  = $request->all();
        $data = $this->categoryRepository->store($inputs);
        return $this->apiResponse($data);
    }

    public function  edit(Request $request,$id){
        $inputs = $request->only(['']);
        $data =  $this->categoryRepository->update($id,$inputs);
        return $this->apiResponse($data);
    }

    public function  show($id){
        $data =  $this->categoryRepository->getById($id);
        return $this->apiResponse($data);
    }

}
