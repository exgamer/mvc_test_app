<?php
namespace Core\Db;

/**
 * Interface DataReadInterface
 * @package Core\Db
 */
interface DataReadInterface
{
    public function oneById(int $id, $condition = null);
    public function oneByCondition($condition);
    public function allByIds(array $ids, $condition = null);
    public function allByCondition($condition);
}
