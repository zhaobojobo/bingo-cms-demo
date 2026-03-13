<?php

namespace App\Domain\Permission\Role;

class RoleDeleter
{
    private $repository;

    public function __construct(RoleDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $count = $this->repository->delete($id);

        return $count;
    }
}
