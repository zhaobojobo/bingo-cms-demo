<?php

namespace App\Domain\Permission\Access;

class AccessDeleter
{
    private $repository;

    public function __construct(AccessDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $count = $this->repository->delete($id);

        return $count;
    }
}
