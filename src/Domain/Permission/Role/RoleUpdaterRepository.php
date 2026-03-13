<?php

namespace App\Domain\Permission\Role;

interface RoleUpdaterRepository
{
    public function update(array $access): int;
}
