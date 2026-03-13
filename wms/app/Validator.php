<?php

namespace Admin;

use App\Exceptions\ValidateException;
use App\Register;

/**
 * Class Validator
 *
 * @package Admin
 */
class Validator
{
    public  $c;

    public function __construct()
    {
        $this->c = Register::get('container');
    }

    /**
     * @param $value
     * @param $langId
     * @param $label
     */
    public function required($value, $langId, $label)
    {
        if (!$value) {
            throw new ValidateException(
                Helper::_(
                    '%s / %s / can not be empty',
                    [
                        $this->c['config']['site']['lang']['languages'][$langId]['label'],
                        $label,
                    ]
                )
            );
        }
    }
}
