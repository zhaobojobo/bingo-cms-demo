<?php

namespace App\Domain\Permission\Agency;

interface AgencyCreatorRepository
{
    public function insert(array $access): int;
}
