<?php

namespace App\Domain\Permission\Agency;

use App\Domain\FinderOfTree;

class AgencyFinder extends FinderOfTree
{
    public function __construct(AgencyFinderRepository $repository)
    {
        parent::__construct($repository);
    }
}
