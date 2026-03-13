<?php

namespace App\Domain\Permission\Agency;

use App\Domain\Data;

/**
 * Class Access
 *
 * @package App\Doman\Permission\Access
 */
class Agency extends Data
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
    private $pid;

    /**
     * Access constructor.
     *
     * @param null|int $id
     * @param string   $name
     * @param int      $status
     * @param int      $sort
     * @param int      $pid
     */
    public function __construct(?int $id, string $name, int $status, int $sort, int $pid)
    {
        $this->id     = $id;
        $this->name   = strtolower($name);
        $this->sort   = $sort;
        $this->status = $status;
        $this->pid    = $pid;
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
            'id'     => $this->id,
            'name'   => $this->name,
            'status' => $this->status,
            'sort'   => $this->sort,
            'pid'    => $this->pid,
        ];
    }
}
