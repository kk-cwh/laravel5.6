<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;


class LinkController extends ApiController
{
    protected $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function  index(){
        $data =  $this->linkRepository->pageToArray();
        return $this->apiResponse($data);
    }

    public function store(Request $request)
    {
        $inputs  = $request->all();
        $data = $this->linkRepository->store($inputs);
        return $this->apiResponse($data);
    }

    public function  update(Request $request,$id){
        $inputs = $request->only(['']);
        $data =  $this->linkRepository->update($id,$inputs);
        return $this->apiResponse($data);
    }

    public function  show($id){
        $data =  $this->linkRepository->getById($id);
        return $this->apiResponse($data);
    }
}
