<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Catalog
 *
 * @package Admin\Models
 */
class Catalog extends Validator
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
