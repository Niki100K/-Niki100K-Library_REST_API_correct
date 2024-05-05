<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function all()
    {
        $this->authorRepository->all();
    }

    public function findById($id)
    {
        $this->authorRepository->findById($id);
    }

    public function create($data)
    {
        $this->authorRepository->create($data);
    }

    public function update($id, $data)
    {
        $this->authorRepository->findById($id, $data);
    }

    public function delete($id)
    {
        $this->authorRepository->delete($id);
    }
}