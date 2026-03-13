<?php

namespace App;

use PDO;
use Exception;
use PDOStatement;
use RuntimeException;

/**
 * Class Db
 *
 * @package Admin
 */
class Db
{
    public $pdo;

    /**
     * Db constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollback()
    {
        $this->pdo->rollBack();
    }

    /**
     * @param string $sql
     * @param array  $params
     *
     * @return bool|PDOStatement
     */
    public function query(string $sql, array $params = [])
    {
        $mode = $this->pdo->getAttribute(PDO::ATTR_ERRMODE);
        if ($mode == PDO::ERRMODE_EXCEPTION) {
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($params);
            } catch (Exception $e) {
                throw new RuntimeException($sql . ' //////// ' . $e->getMessage());
            }
        } else {
            $stmt = $this->pdo->prepare($sql);
            if (false === $stmt) {
                throw new RuntimeException('Invalid prepare statement');
            } elseif (false === $stmt->execute($params)) {
                throw new RuntimeException(implode(' ', $stmt->errorInfo()));
            }
        }
        return $stmt;
    }
}
