<?php
namespace Core\Db;

use Core\Db\Traits\ServiceModifyMethodsTrait;
use Core\Db\Traits\ServiceReadMethodsTrait;
use Core\Helpers\AppHelper;
use ReflectionException;
use Core\Base\Service as Base;

/**
 * Class Service
 * @package Core\Db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Service extends Base implements ServiceInterface, DataModifyInterface, DataReadInterface
{
    use ServiceModifyMethodsTrait;
    use ServiceReadMethodsTrait;

    /**
     * @var Storage
     */
    private $_storage;
    /**
     * @var array
     */
    public $storageConfig = [];

    /**
     * @return Storage
     * @throws ReflectionException
     */
    public function getStorage() : StorageInterface
    {
        if ($this->_storage instanceof StorageInterface){
            return $this->_storage;
        }

        $storage = AppHelper::createObjectFromConfig($this->storageConfig);
        $storage->setConnection($this->getApp()->getDb()->getPdo());
        $this->_storage = $storage;

        return $this->_storage;
    }
}