<?php

namespace App\Repositories;

trait BaseRepository
{
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }


    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }


    public function all()
    {
        return $this->model->get();
    }


    public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    public function pageToArray($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        $data                     = $this->page($number,$sort,$sortColumn)->toArray();
        $results['total']        = array_get($data, 'total');
        $results['current_page'] = array_get($data, 'current_page');
        $results['last_page']    = array_get($data, 'last_page');
        $results['list']         = array_get($data, 'data');
        return $results;
    }


    public function store($input)
    {
        return $this->save($this->model, $input);
    }


    public function update($id, $input)
    {
        $this->model = $this->getById($id);

        return $this->save($this->model, $input);
    }

    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }
}