<?php

namespace Admin\Models;

use Admin\Data;

/**
 * Class Menu
 *
 * @package Admin\Models
 */
class Menu extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table           = 'menu';
        $this->idField         = 'id';
        $this->data            = new Data('menu_data', 'menu_id');
        $this->data->languages = $this->c['config']['lang']['languages'];
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

    public function remove($id, $recursive = false)
    {
        $model = new Nav();
        $model->deleteMore('menu_id=:menu_id', ['menu_id' => $id]);

        return parent::remove($id, $recursive);
    }
}
