<?php

namespace App\Domain\Permission\Agency;

class AgencyDeleter
{
    private $repository;

    public function __construct(AgencyDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $count = $this->repository->delete($id);

        return $count;
    }
}
