<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class ListItem
 *
 * @package Admin\Models
 */
class ListItem extends Validator
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
