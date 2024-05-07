<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->model->update($id, $data);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}