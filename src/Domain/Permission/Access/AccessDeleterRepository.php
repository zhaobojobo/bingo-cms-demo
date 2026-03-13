<?php

namespace App\Domain\Permission\Access;

interface AccessDeleterRepository
{
    public function delete($id): int;
}
