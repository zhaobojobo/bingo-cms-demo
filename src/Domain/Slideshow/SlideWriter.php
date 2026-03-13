<?php

namespace App\Domain\Slideshow;

use App\Exceptions\ValidationException;

class SlideWriter
{
    private $repository;

    public function __construct(SlideWriteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        $this->validateInsertSlide($data);

        return $this->repository->insert($data);
    }

    public function update(array $data)
    {
        $this->validateUpdateSlide($data);

        return $this->repository->update($data);
    }

    private function validateInsertSlide($data)
    {
        $errors = [];

        if (empty($data['image'])) {
            $errors['image'] = 'Input required';
        }

        if (empty($data['slideshow_id'])) {
            $errors['slideshow_id'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }

    private function validateUpdateSlide($data)
    {
        $errors = [];

        if (empty($data['image'])) {
            $errors['image'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
