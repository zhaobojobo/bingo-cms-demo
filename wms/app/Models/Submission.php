<?php

namespace Admin\Models;

/**
 * Class Submission
 *
 * @package Admin\Models
 */
class Submission extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'submission';
        $this->idField = 'id';
    }

    /**
     * @param $fid
     *
     * @return mixed
     */
    public function getCount($fid)
    {
        return $this->query->count($this->table, "form_id={$fid}");
    }

    /**
     * @param $fid
     * @return mixed
     */
    public function getReviewCount($fid)
    {
        return $this->query->count($this->table, "form_id={$fid} AND review=1");
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateStatus($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }
}
