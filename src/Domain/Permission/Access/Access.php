<?php

namespace App\Domain\Permission\Access;

use App\Domain\Data;

/**
 * Class Access
 *
 * @package App\Doman\Permission\Access
 */
class Access extends Data
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
     * @var string
     */
    private $access_code;

    /**
     * @var string
     */
    private $access_group;

    /**
     * @var int
     */
    private $access_type;

    /**
     * @var int
     */
    private $linkable;

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
     * @param string   $route
     * @param int      $status
     * @param int      $sort
     * @param int      $pid
     */
    public function __construct(
        ?int $id,
        string $name,
        string $route,
        ?string $access_code,
        string $access_group,
        int $access_type,
        int $linkable,
        int $status,
        int $sort,
        int $pid
    ) {
        $this->id           = $id;
        $this->name         = $name;
        $this->route        = $route;
        $this->access_code  = $access_code;
        $this->access_group = $access_group;
        $this->access_type  = $access_type;
        $this->linkable     = $linkable;
        $this->status       = $status;
        $this->sort         = $sort;
        $this->pid          = $pid;
    }

    /**
     * @return string
     */
    public function getAccessCode(): ?string
    {
        return $this->access_code;
    }

    /**
     * @return int
     */
    public function getAccessType(): int
    {
        return $this->access_type;
    }

    /**
     * @return string
     */
    public function getAccessGroup(): string
    {
        return $this->access_group;
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
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return int
     */
    public function getLinkable(): int
    {
        return $this->linkable;
    }

    /**
     * @return string
     */
    public function showLinkable(): string
    {
        return $this->linkable ? 'yes' : 'no';
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
            'id'           => $this->id,
            'name'         => $this->name,
            'route'        => $this->route,
            'access_code'  => $this->access_code,
            'access_group' => $this->access_group,
            'access_type'  => $this->access_type,
            'linkable'     => $this->linkable,
            'status'       => $this->status,
            'sort'         => $this->sort,
            'pid'          => $this->pid,
        ];
    }
}
