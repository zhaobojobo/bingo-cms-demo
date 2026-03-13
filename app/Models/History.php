<?php

namespace Site\Models;

use Site\Model;

/**
 * Class History
 *
 * @package Admin\Models
 */
class History extends Model
{
    public $table;

    public function __construct()
    {
        parent::__construct('history', 'id');
        $this->hasMain = true;
    }

    /**
     * @param $post
     * @param $type
     *
     * @return bool
     */
    public function append($post, $type)
    {
        $data  = [
            'type'         => $type,
            'time'         => $post['update_time'],
            'version'      => $this->version($post),
            'content_id'   => $post['id'],
            'content_data' => $this->serialize($post),
        ];
        $where = "content_id={$post['id']} AND type='{$type}' AND version='{$data['version']}'";
        if ($one = $this->findOne($where)) {
            return $this->update(['time' => $post['update_time']], $one['id']);
        }
        $model = null;
        if ($type == 'page') {
            $model = new Page();
        }
        if ($type == 'post') {
            $model = new Post();
        }
        if ($model) {
            $model->updateStatus(['review' => 0], $post['id']);
        }
        $this->remove($post, $type);

        return parent::create($data);
    }

    /**
     * @param $post
     *
     * @return string
     */
    public function version($post)
    {
        return md5($this->serialize($post));
    }

    /**
     * @param $post
     *
     * @return false|string
     */
    private function serialize($post)
    {
        return serialize(
            [
                '__data'    => $post['__data'],
                '__profile' => $post['__profile'],
            ]
        );
    }

    /**
     * @param $post
     * @param $type
     *
     * @return bool
     */
    public function remove($post, $type)
    {
        $histories = $this->histories($post, $type);
        $count     = count($histories);
        if ($count >= 5) {
            $last = $histories[$count - 1];

            return $this->deleteMore("content_id={$post['id']} AND time < '{$last['time']}'");
        }

        return true;
    }

    /**
     * @param $post
     * @param $type
     *
     * @return array
     */
    public function histories($post, $type)
    {
        $version = $this->version($post);
        $where   = "content_id={$post['id']} AND type='{$type}' AND version <> '{$version}'";

        return parent::findSome($where, [], 'time DESC', 5);
    }
}
