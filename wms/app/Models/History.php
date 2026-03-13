<?php

namespace Admin\Models;

use Admin\Model;
use Admin\Helper;

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
        parent::__construct();
        $this->table   = 'history';
        $this->idField = 'id';
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
            $change = $this->update(['time' => $post['update_time']], $one['id']);
        } else {
            $change = parent::create($data);
        }

        if ($change) {
            $this->remove($post, $type);
        }

        return $change;
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
