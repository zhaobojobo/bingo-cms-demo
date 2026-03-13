<?php

namespace Site\Models;

/**
 * Class Submission
 *
 * @package Site\Models
 */
class Submission extends Base
{
    public function __construct()
    {
        parent::__construct('submission', 'id');
    }

    /**
     * @param $fid
     *
     * @return mixed
     */
    public function getCount($fid)
    {
        return $this->query->count($this->table, "form_id=:form_id", ['form_id' => $fid]);
    }

    /**
     * @param $fid
     * @return mixed
     */
    public function getReviewCount($fid)
    {
        return $this->query->count(
            $this->table,
            "form_id=:form_id AND review=:review",
            ['form_id' => $fid, 'review' => 1]
        );
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
