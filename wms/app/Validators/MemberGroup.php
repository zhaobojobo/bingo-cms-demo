<?php

namespace Admin\Validators;

use Admin\Helper;
use Admin\Validator;

/**
 * Class MemberGroup
 *
 * @package Admin\Models
 */
class MemberGroup extends Validator
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
