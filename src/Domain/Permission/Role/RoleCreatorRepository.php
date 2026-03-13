<?php

namespace App\Domain\Permission\Role;

interface RoleCreatorRepository
{
    public function insert(array $role): int;
}
