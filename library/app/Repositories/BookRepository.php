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
        $this->model->all();
    }

    public function findById($id)
    {
        $this->model->findOrFail($id);
    }

    public function create($data)
    {
        $this->model->create($data);
    }

    public function update($id, $data)
    {
        $this->model->findOrFail($id, $data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
    }
}