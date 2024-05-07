<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function all()
    {
        return $this->bookRepository->all();
    }

    public function findById($id)
    {
        return $this->bookRepository->findById($id);
    }

    public function create($data)
    {
        return $this->bookRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->bookRepository->delete($id);
    }
}