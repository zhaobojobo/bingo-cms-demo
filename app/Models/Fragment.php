<?php


namespace Site\Models;


class Fragment extends \Site\Model
{
    public function __construct()
    {
        parent::__construct('fragment', 'id');
        $this->hasMain = true;
    }

    public function getCache($id)
    {
        $cache = parent::cache(md5('fragment-' . $id));
        return \Site\Model::normalize($cache);
    }
}
