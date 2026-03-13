<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Menu
 *
 * @package Admin\Models
 */
class Menu extends Validator
{
    /**
     * @param $langId
     * @param $data
     */
    public function validate($langId, $data)
    {
        $this->required($data['position'], $langId, Helper::_('Position'));
    }
}
