<?php
namespace Core\Db;

use Core\Base\ServiceInterface as Base;

/**
 * Interface ServiceInterface
 * @package Core\Db
 */
interface ServiceInterface extends Base
{
    public function getStorage(): StorageInterface;
}
