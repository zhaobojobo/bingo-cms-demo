<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class ListData
 *
 * @package Admin\Models
 */
class ListData extends Validator
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
