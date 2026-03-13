<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Model
 *
 * @package Admin\Models
 */
class Model extends Validator
{
    /**
     * @param $langId
     * @param $data
     */
    public function validate($langId, $data)
    {
        $this->required($data['name'], $langId, Helper::_('Name'));
    }
}
