<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Nav
 *
 * @package Admin\Models
 */
class Nav extends Validator
{
    /**
     * @param $langId
     * @param $data
     */

    public function validate($langId, $data)
    {
        $this->required($data['text'], $langId, Helper::_('Nav Text'));
    }
}
