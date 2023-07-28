<?php

namespace App\Services\UserService\Contract;

interface UserServiceContract
{
    public function getUser(int $id);

    public function getAllUsers();

    public function createUser(array $data);

    public function updateUser(int $id, array $data);

    public function removeUser(int $id);
}
