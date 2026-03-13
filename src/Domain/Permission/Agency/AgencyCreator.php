<?php

namespace App\Domain\Permission\Agency;

use App\Exceptions\ValidationException;

class AgencyCreator
{
    private $repository;

    public function __construct(AgencyCreatorRepository $repository)
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
