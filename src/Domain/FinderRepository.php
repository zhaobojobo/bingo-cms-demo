<?php

namespace App\Domain;

interface FinderRepository
{
    /**
     * @return Data[]
     */
    public function findAll();

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOneOfId(int $id);
}
