<?php

namespace App\Domain\Permission\Agency;

class AgencyUpdater
{
    private $repository;

    public function __construct(AgencyUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($data)
    {
        $count = $this->repository->update($data);

        return $count;
    }
}
