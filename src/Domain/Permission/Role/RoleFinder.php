<?php

namespace App\Domain\Permission\Role;

use App\Domain\FinderOfTree;

class RoleFinder extends FinderOfTree
{
    public function __construct(RoleFinderRepository $repository)
    {
        parent::__construct($repository);
    }

    public function findChildren(int $id)
    {
        $roles = $this->repository->findChildren($id);

        return $roles;
    }

    public function findDescendants(int $id)
    {
        function finder($id, $object)
        {
            $roles = $object->findChildren($id);
            if ($roles) {
                foreach ($roles as $role) {
                    $roles = array_merge($roles, finder($role->getId(), $object));
                }
            }

            return $roles;
        }

        return finder($id, $this);
    }
}
