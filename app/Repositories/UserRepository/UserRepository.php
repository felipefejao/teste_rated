<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\BaseRepository\BaseRepository;
use App\Repositories\UserRepository\Contract\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
