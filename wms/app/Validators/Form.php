<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Form
 *
 * @package Admin\Models
 */
class Form extends Validator
{

    /**
     * @param $langId
     * @param $data
     */
    public function validate($langId, $data)
    {
        $this->required($data['title'], $langId, Helper::_('Title'));
        $this->required($data['submit_btn_text'], $langId, Helper::_('Submit Button Text'));
    }
}
