<?php

namespace Site;

use ArrayObject;

/**
 * Class DataObject
 * @package Admin
 */
class DataObject extends ArrayObject
{
    protected $input;

    /**
     * DataObject constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if ($this->offsetExists($name)) {
            return $this->offsetGet($name);
        }
        return null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        if ($this->offsetExists($name)) {
            $this->offsetUnset($name);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return $this->offsetExists($name);
    }
}
