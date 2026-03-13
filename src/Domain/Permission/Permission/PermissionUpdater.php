<?php

namespace App\Domain\Permission\Permission;

class PermissionUpdater
{
    private $repository;

    public function __construct(PermissionUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($data)
    {
        $count = $this->repository->update($data);

        return $count;
    }

    public function on($data)
    {
        $count = $this->repository->statusOn($data);

        return $count;
    }

    public function off($data)
    {
        $count = $this->repository->statusOff($data);

        return $count;
    }
}
