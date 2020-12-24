<?php
namespace Core\Db;

use Core\Base\BaseObject;
use Core\Db\Traits\StorageModifyMethodsTrait;
use Core\Db\Traits\StorageReadMethodsTrait;
use Exception;
use PDO;

/**
 * Class Storage
 * @package concepture\php\data\core\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Storage extends BaseObject implements StorageInterface, StorageQueryBuilderInterface
{
    use StorageModifyMethodsTrait;
    use StorageReadMethodsTrait;

    /**
     * @var PDO
     */
    protected $connection;

    /**
     * @param PDO $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return PDO
     * @throws Exception
     */
    protected function getConnection() : PDO
    {
        if (! $this->connection){
            throw new Exception("Please set Db Connection");
        }
        return $this->connection;
    }

    /**
     * @return string
     */
    protected abstract function getTableName() : string ;
}