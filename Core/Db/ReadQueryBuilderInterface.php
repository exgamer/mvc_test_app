<?php
namespace Core\Db;

/**
 * Interface ReadQueryBuilderInterface
 * @package Core\Db
 */
interface ReadQueryBuilderInterface  extends QueryBuilderInterface
{
    public function makeSelectSql();
}
