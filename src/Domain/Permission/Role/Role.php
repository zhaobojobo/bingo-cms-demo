<?php

namespace App\Domain\Permission\Role;

use App\Domain\Data;

/**
 * Class Role
 *
 * @package App\Doman\Permission\Role
 */
class Role extends Data
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $route;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $sort;

    /**
     * @var int
     */
    private $agency_id;

    /**
     * @var int
     */
    private $pid;

    /**
     * Role constructor.
     *
     * @param null|int $id
     * @param string   $name
     * @param int      $status
     * @param int      $sort
     * @param int      $agency_id
     * @param int      $pid
     */
    public function __construct(?int $id, string $name, int $status, int $sort, int $agency_id, int $pid)
    {
        $this->id        = $id;
        $this->name      = strtolower($name);
        $this->sort      = $sort;
        $this->agency_id = $agency_id;
        $this->status    = $status;
        $this->pid       = $pid;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @return int
     */
    public function getAgencyId(): int
    {
        return $this->agency_id;
    }

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'status'    => $this->status,
            'agency_id' => $this->agency_id,
            'pid'       => $this->pid,
            'sort'      => $this->sort,
        ];
    }
}
