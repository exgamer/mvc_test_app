<?php
namespace Core\Db;

/**
 * Interface QueryBuilderInterface
 * @package Core\Db
 */
interface QueryBuilderInterface
{
    public function setSql(string $sql);
    public function setParams(array $params) ;
    public function getSql() : string;
    public function getParams() : array;
}
