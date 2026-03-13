<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class Album
 *
 * @package Admin\Models
 */
class Album extends Validator
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
