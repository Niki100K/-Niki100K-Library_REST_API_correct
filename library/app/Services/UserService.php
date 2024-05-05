<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        $this->userRepository->all();
    }

    public function findById($id)
    {
        $this->userRepository->findById($id);
    }

    public function create($data)
    {
        $this->userRepository->create($data);
    }

    public function update($id, $data)
    {
        $this->userRepository->findById($id, $data);
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);
    }
}