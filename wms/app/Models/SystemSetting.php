<?php


namespace Admin\Models;

class SystemSetting extends \Admin\Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'system_setting';
        $this->idField = 'id';
    }
}