<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Field
 *
 * @package Admin\Models
 */
class Field extends Validator
{
    /**
     * @param $langId
     * @param $data
     */
    public function validate($langId, $data)
    {
        $this->required($data['label'], $langId, Helper::_('Label'));
    }
}
