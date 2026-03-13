<?php

namespace App\Domain\Permission\Permission;

class PermissionCreator
{
    private $repository;

    public function __construct(PermissionCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $id = $this->repository->insert($data);

        return $id;
    }
}
