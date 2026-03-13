<?php

namespace Site\Models;

use Site\Data;
use Site\Helper;

/**
 * Class Menu
 *
 * @package Admin\Models
 */
class Menu extends Base
{
    public function __construct()
    {
        parent::__construct('menu', 'id');
        $this->data            = new Data('menu_data', 'menu_id');
        $this->data->languages = $this->c['languages'];
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::create($data);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    public function findByName($cname)
    {
        $menu = parent::findOne("cname=:cname", ['cname' => $cname]);

        return $menu;
    }
}
