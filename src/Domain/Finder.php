<?php

namespace App\Domain;

abstract class Finder
{
    protected $repository;

    public function __construct(FinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Data[]
     */
    public function findAll(): array
    {
        $objects = $this->repository->findAll();

        return $objects;
    }

    public function findOneOfId(int $id): ?Data
    {
        $object = $this->repository->findOneOfId($id);

        return $object;
    }
}
