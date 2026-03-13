<?php

namespace App\Domain\Permission\Role;

interface RoleDeleterRepository
{
    public function delete($id): int;
}
