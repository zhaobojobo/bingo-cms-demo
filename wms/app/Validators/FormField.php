<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class FormField
 *
 * @package Admin\Models
 */
class FormField extends Validator
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
