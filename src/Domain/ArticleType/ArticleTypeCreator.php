<?php

namespace App\Domain\ArticleType;

use App\Exceptions\ValidationException;

class ArticleTypeCreator
{
    private $repository;

    public function __construct(ArticleTypeCreatorRepository $repository)
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

        if (!preg_match('/^[a-z]+(-[a-z]+)*$/',$data['name'])) {
            $errors['name'] = 'Only English lowercase letters a~z and -';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
