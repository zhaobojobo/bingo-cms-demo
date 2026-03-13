<?php

namespace App\Domain\Permission\Access;

use App\Domain\FinderOfTree;

class AccessFinder extends FinderOfTree
{
    public function __construct(AccessFinderRepository $repository)
    {
        parent::__construct($repository);
    }

    public function findAllOfLinkable(): array
    {
        $accesses = $this->repository->findAllOfLinkable();

        return $accesses;
    }

    public function findOneOfCode(string $accessCode): ?Access
    {
        $accesses = $this->repository->findOneOfCode($accessCode);

        return $accesses;
    }
}
