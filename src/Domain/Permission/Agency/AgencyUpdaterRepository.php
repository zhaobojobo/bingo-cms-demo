<?php

namespace App\Domain\Permission\Agency;

interface AgencyUpdaterRepository
{
    public function update(array $access): int;
}
