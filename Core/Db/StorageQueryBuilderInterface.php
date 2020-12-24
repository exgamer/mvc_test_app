<?php
namespace Core\Db;

/**
 * Interface StorageQueryBuilderInterface
 * @package Core\Db
 */
interface StorageQueryBuilderInterface
{
    public function getReadQueryBuilder() : ReadQueryBuilderInterface;
    public function getModifyQueryBuilder() : ModifyQueryBuilderInterface;
}
