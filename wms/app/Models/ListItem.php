<?php

namespace Admin\Models;

use Admin\Data;
use Admin\Profile;

class ListItem extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'list_item';
        $this->idField = 'id';
        $this->profile = new Profile('list_item_profile', 'list_item_id');
    }
}
