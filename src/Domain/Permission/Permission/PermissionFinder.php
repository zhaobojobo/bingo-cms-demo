<?php

namespace App\Domain\Permission\Permission;

use App\Domain\Finder;

class PermissionFinder extends Finder
{
    public function __construct(PermissionFinderRepository $repository)
    {
        parent::__construct($repository);
    }

    public function findOneOfAccess($access_id, $role_id)
    {
        $permission = $this->repository->findOneOfAccess($access_id, $role_id);

        return $permission;
    }
}
