<?php

namespace App\Domain\Permission\Permission;

use App\Domain\FinderRepository;

/**
 * Interface PermissionFinderRepository
 *
 * @package App\Doman\Permission\Permission
 */
interface PermissionFinderRepository extends FinderRepository
{
    public function findOneOfAccess(int $access_id, int $role_id);
}
