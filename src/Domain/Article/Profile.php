<?php

namespace App\Domain\Article;

class Profile
{
    private $data;

    public function __construct($rows)
    {
        $this->data = [];
        foreach ($rows as $row) {
            $this->data[$row['lang']][$row['profile_key']] = $row['profile_value'];
        }
    }

    public function getProfiles($lang)
    {
        $data = array_merge($this->data[''], $this->data[$lang]);

        return $data;
    }
}
