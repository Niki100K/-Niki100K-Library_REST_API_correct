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
        return $this->authorRepository->all();
    }

    public function findById($identifier)
    {
        return $this->authorRepository->findById($identifier);
    }

    public function create($data)
    {
        return $this->authorRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->authorRepository->delete($id);
    }
}