<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;


class TagController extends ApiController
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function  index(){
        $data =  $this->tagRepository->pageToArray();
        return $this->apiResponse($data);
    }
    public function store(Request $request)
    {
        $inputs  = $request->all();
        $data = $this->tagRepository->store($inputs);
        return $this->apiResponse($data);
    }
    public function  update(Request $request,$id){
        $inputs = $request->only(['']);
        $data =  $this->tagRepository->update($id,$inputs);
        return $this->apiResponse($data);
    }

    public function  show($id){
        $data =  $this->tagRepository->getById($id);
        return $this->apiResponse($data);
    }
}
