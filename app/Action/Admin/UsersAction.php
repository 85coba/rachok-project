<?php

namespace App\Action\Admin;

use App\Repository\UserRepository;
use Auth;

final class UsersAction
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        $admin = Auth::user();
        $users = $this->repository->getAllUsers();

        return array('admin' => $admin, 'users' => $users);
    }
}