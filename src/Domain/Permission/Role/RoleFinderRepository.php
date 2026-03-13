<?php

namespace App\Domain\Permission\Role;

use App\Domain\FinderRepository;

/**
 * Interface RoleFinderRepository
 *
 * @package App\Doman\Permission\Role
 */
interface RoleFinderRepository extends FinderRepository
{
    public function findChildren(int $id): array;
}
