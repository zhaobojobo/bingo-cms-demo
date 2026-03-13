<?php

namespace App\Domain\Permission\Access;

class AccessUpdater
{
    private $repository;

    public function __construct(AccessUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($data)
    {
        $count = $this->repository->update($data);

        return $count;
    }

    public function sorts($data)
    {
        $count = $this->repository->sorts($data);

        return $count;
    }
}
