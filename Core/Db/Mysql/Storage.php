<?php
namespace Core\Db\Mysql;

use Core\Db\ModifyQueryBuilderInterface;
use Core\Db\Mysql\Read\QueryBuilder as ReadQueryBuilder;
use Core\Db\Mysql\Modify\QueryBuilder as ModifyQueryBuilder;
use Core\Db\ReadQueryBuilderInterface;
use Core\Db\Storage as Base;

/**
 * Class Storage
 * @package Core\Db\Mysql
 * @author citizenzet <exgamer@live.ru>
 */
abstract class Storage extends Base
{
    /**
     * @return ReadQueryBuilderInterface
     */
    public function getReadQueryBuilder(): ReadQueryBuilderInterface
    {
        return new ReadQueryBuilder();
    }

    /**
     * @return ModifyQueryBuilderInterface
     */
    public function getModifyQueryBuilder(): ModifyQueryBuilderInterface
    {
        return new ModifyQueryBuilder();
    }
}