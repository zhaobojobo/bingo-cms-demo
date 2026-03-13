<?php

namespace App\Domain\Permission\Access;

interface AccessCreatorRepository
{
    public function insert(array $access): int;
}
