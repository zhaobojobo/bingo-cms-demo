<?php

namespace App;

use App\Exceptions\SQLException;

/**
 * Class SQL
 *
 * @package Admin
 */
class SQL
{
    protected $table;

    protected $fields;

    protected $where;

    protected $group;

    protected $having;

    protected $order;

    protected $limit;

    protected $offset;

    public function __construct()
    {
        $this->table  = '';
        $this->fields = '*';
        $this->where  = 0;
        $this->group  = '';
        $this->having = '';
        $this->order  = '';
        $this->limit  = 0;
        $this->offset = 0;
    }

    /**
     * @return SQL
     */
    public static function getInstance(): SQL
    {
        return new self();
    }

    /**
     * @param        $map
     * @param string $_part
     * @param string $prefix
     *
     * @return array
     */
    public static function params(array $map, string $_part = '', string $prefix = ''): array
    {
        $params = [];
        foreach ($map as $key => $value) {
            $params[":{$prefix}{$key}"] = $value;
        }

        if ($_part) {
            return self::checkParams($_part, $params);
        }

        return $params;
    }

    /**
     * @param $part
     * @param $params
     *
     * @return mixed
     */
    public static function checkParams(string $part, array $params)
    {
        $paramNames = array_keys($params);
        foreach ($paramNames as $name) {
            if (false === strpos($part, $name)) {
                throw new SQLException(
                    sprintf(
                        'Binding parameter %s did not find a match in %s',
                        $name,
                        $part
                    )
                );
            }
        }

        return $params;
    }

    /**
     * @param $table
     *
     * @return SQL
     */
    public function table(string $table): SQL
    {
        $this->table = strval($table);

        return $this;
    }

    /**
     * @param string $fields
     *
     * @return SQL
     */
    public function fields(string $fields = '*'): SQL
    {
        $this->fields = strval($fields);

        return $this;
    }

    /**
     * @param $where
     *
     * @return SQL
     */
    public function where(string $where): SQL
    {
        $this->where = $where;

        return $this;
    }

    /**
     * @param $group
     *
     * @return SQL
     */
    public function group(string $group): SQL
    {
        $this->group = strval($group);

        return $this;
    }

    /**
     * @param $having
     *
     * @return SQL
     */
    public function having(string $having): SQL
    {
        $this->having = strval($having);

        return $this;
    }

    /**
     * @param $order
     *
     * @return SQL
     */
    public function order(string $order): SQL
    {
        $this->order = strval($order);

        return $this;
    }

    /**
     * @param $limit
     *
     * @return SQL
     */
    public function limit(int $limit): SQL
    {
        $this->limit = intval($limit);

        return $this;
    }

    /**
     * @param $offset
     *
     * @return SQL
     */
    public function offset(int $offset): SQL
    {
        $this->offset = intval($offset);

        return $this;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function insert(array $data): string
    {
        $set = self::set($data);
        if (! $set) {
            throw new SQLException('SQL data is null');
        }

        return "INSERT INTO {$this->table} SET {$set}";
    }

    /**
     * @param $data
     *
     * @return string
     */
    public static function set(array $data): string
    {
        $set    = [];
        $fields = array_keys($data);
        foreach ($fields as &$field) {
            $set[] = "`$field`=:{$field}";
        }

        return implode(',', $set);
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function update(array $data): string
    {
        if (! $this->table) {
            throw new SQLException('SQL table is null');
        }
        $set = self::set($data);
        if (! $set) {
            throw new SQLException('SQL data is null');
        }
        $where  = $this->where ?: 0;
        $update = "UPDATE {$this->table} SET {$set} WHERE {$where}";
        if ($this->order) {
            $update .= " ORDER BY {$this->order}";
        }
        if ($this->limit) {
            $update .= " LIMIT {$this->limit}";
        }

        return $update;
    }

    /**
     * @return string
     */
    public function delete(): string
    {
        if (! $this->table) {
            throw new SQLException('SQL table is null');
        }
        $where  = $this->where ?: 0;
        $delete = "DELETE FROM {$this->table} WHERE {$where}";
        if ($this->limit > 0) {
            if ($this->order) {
                $delete .= " ORDER BY {$this->order}";
            }
            $delete .= " LIMIT {$this->limit}";
        }

        return $delete;
    }

    /**
     * @return string
     */
    public function find(): string
    {
        if (! $this->table) {
            throw new SQLException('SQL table is null');
        }

        if (! $this->fields) {
            throw new SQLException('SQL fields is null');
        }

        $find = "SELECT {$this->fields} FROM {$this->table}";

        if ($this->where) {
            $find .= " WHERE {$this->where}";
        }

        if ($this->group) {
            $find .= " GROUP BY {$this->group}";
            if ($this->having) {
                $find .= " HAVING {$this->having}";
            }
        }

        if ($this->order) {
            $find .= " ORDER BY {$this->order}";
        }

        if ($this->limit > 0) {
            $find .= " LIMIT {$this->limit}";
            if ($this->offset > 0) {
                $find .= " OFFSET {$this->offset}";
            }
        }

        return $find;
    }
}
