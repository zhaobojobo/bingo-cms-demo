<?php

namespace App\Domain\Permission\Access;

interface AccessUpdaterRepository
{
    public function update(array $access): int;
    public function sorts(array $sorts): int;
}
