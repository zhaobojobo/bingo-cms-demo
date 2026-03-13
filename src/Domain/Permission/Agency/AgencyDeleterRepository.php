<?php

namespace App\Domain\Permission\Agency;

interface AgencyDeleterRepository
{
    public function delete($id): int;
}
