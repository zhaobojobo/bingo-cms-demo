<?php

namespace App\Domain\Permission\Permission;

use App\Domain\Data;

/**
 * Class Permission
 *
 * @package App\Doman\Permission\permission
 */
class Permission extends Data
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var int
     */
    private $role_id;

    /**
     * @var int
     */
    private $access_id;

    /**
     * @var int
     */
    private $status;

    /**
     * Permission constructor.
     *
     * @param null|int $id
     * @param int      $role_id
     * @param int      $access_id
     * @param int      $status
     */
    public function __construct(?int $id, int $role_id, int $access_id, int $status)
    {
        $this->id        = $id;
        $this->role_id   = $role_id;
        $this->access_id = $access_id;
        $this->status    = $status;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @return int
     */
    public function getAccessId(): int
    {
        return $this->access_id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function showStatus(): string
    {
        return $this->status ? 'on' : 'off';
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'role_id'   => $this->role_id,
            'access_id' => $this->access_id,
            'status'    => $this->status,
        ];
    }
}
