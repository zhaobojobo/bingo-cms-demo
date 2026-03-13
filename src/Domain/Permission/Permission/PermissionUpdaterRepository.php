<?php

namespace App\Domain\Permission\Permission;

interface PermissionUpdaterRepository
{
    public function update(array $permission);

    public function statusOn(array $permission);

    public function statusOff(array $permission);
}
