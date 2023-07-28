<?php

namespace App\Services\UserService;

use App\Repositories\UserRepository\Contract\UserRepositoryContract;
use App\Services\UserService\Contract\UserServiceContract;

class UserService implements UserServiceContract
{
    private $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser(int $id)
    {

        return $this->userRepository->find($id);
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function updateUser(int $id, array $data)
    {
        return $this->userRepository->update($id, [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function removeUser(int $id)
    {
        return $this->userRepository->delete($id);
    }
}
