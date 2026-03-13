<?php

namespace App\Domain\Permission\Role;

use App\Exceptions\ValidationException;

class RoleCreator
{
    private $repository;

    public function __construct(RoleCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $this->validate($data);

        $id = $this->repository->insert($data);

        return $id;
    }

    public function validate(array $data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
