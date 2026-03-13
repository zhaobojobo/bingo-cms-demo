<?php

namespace App\Domain\Permission\Permission;

interface PermissionDeleterRepository
{
    public function delete($id);
}
