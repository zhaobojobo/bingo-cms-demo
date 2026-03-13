<?php

namespace App\Domain\Permission\Permission;

interface PermissionCreatorRepository
{
    public function insert(array $access);
}
