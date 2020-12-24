<?php

namespace Core\Base;

use PDO;

/**
 * Класс для соединения с БД
 *
 * Class Db
 * @package App\Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Db extends BaseObject
{
    /**
     * @var string dsn
     */
    public $dsn;
    /**
     * @var string username
     */
    public $username;
    /**
     * @var string password
     */
    public $password;

    /**
     * @var array
     */
    public $attributes = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Для примера mysql
     * Возвращает PDO
     *
     * @return PDO
     */
    public function getPdo()
    {
        if ($this->pdo) {
            return $this->pdo;
        }

        $this->initConnection();
        return $this->pdo;
    }

    /**
     * инициализация соединения с БД
     */
    protected function initConnection()
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->attributes);
            //For utf8 the default collation is utf8_general_ci
            $this->pdo->exec("SET names 'utf8mb4' COLLATE 'utf8mb4_bin'");
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}