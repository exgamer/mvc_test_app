<?php

namespace Storages;


use Core\Db\Mysql\Storage;

class TaskStorage extends Storage
{
    /**
     * @return string
     */
    protected function getTableName(): string
    {
        return "task";
    }
}