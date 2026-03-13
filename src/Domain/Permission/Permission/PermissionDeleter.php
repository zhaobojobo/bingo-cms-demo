<?php

namespace App\Domain\Permission\Permission;

class PermissionDeleter
{
    private $repository;

    public function __construct(PermissionDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $count = $this->repository->delete($id);

        return $count;
    }
}
