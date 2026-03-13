<?php

namespace App\Models;

use PDO;

class Form
{
    protected array $fields;

    public function __construct(PDO $pdo)
    {

    }

    public function addField()
    {

    }

    public function getFields()
    {
        return $this->fields;
    }
}
