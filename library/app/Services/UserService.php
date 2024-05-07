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
        return $this->userRepository->all();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}