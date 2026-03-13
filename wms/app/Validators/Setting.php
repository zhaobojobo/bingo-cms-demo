<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Setting
 *
 * @package Admin\Models
 */
class Setting extends Validator
{
    /**
     * @param $langId
     * @param $data
     */
    public function validate($langId, $data)
    {
        $this->required($data['title'], $langId, Helper::_('Title'));
    }
}
