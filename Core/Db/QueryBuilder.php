<?php
namespace Core\Db;

use Core\Base\BaseObject;

/**
 * Class QueryBuilder
 * @package Core\Db
 * @author citizenzet <exgamer@live.ru>
 */
class QueryBuilder extends BaseObject implements QueryBuilderInterface
{
    /**
     * @var string
     */
    protected $sql;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param $sql
     * @return string
     */
    public function setSql(string $sql)
    {
        $this->sql = $sql;
    }

    /**
     * @param $params
     * @return array
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getSql() : string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getParams() : array
    {
        return $this->params;
    }
}
