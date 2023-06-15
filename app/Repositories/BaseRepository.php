<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->perPage = config('enums.itemPerPage');
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getPaginated($page = null)
    {
        return $this->model->orderBy('id', 'DESC')->paginate($page ? $page : $this->perPage);
    }

    public function getPaginatedWithFilter($page = null, $filter)
    {
        return $this->model->filter($filter)->orderBy('id', 'DESC')->paginate($page ?? $this->perPage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function update(array $data, $id)
    {
        $result = $this->getById($id);
        $result->fill($data);

        return $result->push();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function printJson($message, $success = false,  $data = null, $httpStatus = 200)
    {
        return response()->json([
            "success" => $success,
            "message" => $message,
            "data" => $data,
        ],$httpStatus);
    }


}
