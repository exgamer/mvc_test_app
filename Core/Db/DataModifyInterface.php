<?php
namespace Core\Db;

/**
 * Interface DataModifyInterface
 * @package Core\Db
 */
interface DataModifyInterface
{
    public function persist(array $data) : int ;
    public function update(array $params, $condition) : bool ;
    public function remove($condition) : bool ;
}