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
        $this->bookRepository->all();
    }

    public function findById($id)
    {
        $this->bookRepository->findById($id);
    }

    public function create($data)
    {
        $this->bookRepository->create($data);
    }

    public function update($id, $data)
    {
        $this->bookRepository->findById($id, $data);
    }

    public function delete($id)
    {
        $this->bookRepository->delete($id);
    }
}