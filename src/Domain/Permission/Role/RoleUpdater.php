<?php

namespace App\Domain\Permission\Role;

class RoleUpdater
{
    private $repository;

    public function __construct(RoleUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($data)
    {
        $count = $this->repository->update($data);

        return $count;
    }
}
