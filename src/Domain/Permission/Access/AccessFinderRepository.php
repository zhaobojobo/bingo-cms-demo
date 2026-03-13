<?php

namespace App\Domain\Permission\Access;

use App\Domain\FinderRepository;

/**
 * Interface AccessFinderRepository
 *
 * @package App\Doman\Permission\Access
 */
interface AccessFinderRepository extends FinderRepository
{
    public function findAllOfLinkable(): array;

    public function findOneOfCode(string $accessCode): ?Access;
}
