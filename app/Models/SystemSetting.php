<?php


namespace Site\Models;

class SystemSetting extends \Site\Model
{
    public function __construct()
    {
        parent::__construct('system_setting', 'id');
    }
}