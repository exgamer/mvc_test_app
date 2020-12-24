<?php
namespace Core\Db\Traits;

use Core\Db\ReadConditionInterface;
use Core\Db\QueryBuilderInterface;
use Core\Db\ReadQueryBuilderInterface;

/**
 * Trait StorageReadMethodsTrait
 * @package Core\Db\Traits
 */
trait StorageReadMethodsTrait
{
    public function getCount()
    {
        $stmt = $this->buildPdoStatement("SELECT FOUND_ROWS()", []);

        return $stmt->fetchColumn();
    }

    /**
     * Возвращает одну запись по id
     * @param int $id
     *
     * Пример расширения запроса через $callback
     * function(ReadQueryBuilderInterface $builder) {
     *       $builder->andWhere("object_type = :object_type", [':object_type' => 2]);
     * }
     *
     * @param array|callable $condition
     * @return array
     */
    public function oneById(int $id, $condition = null)
    {
        $builder = $this->getReadQueryBuilder();
        $builder->andWhere(['id' => $id]);
        if ($condition) {
            if (is_callable($condition)) {
                call_user_func($condition, $builder);
            } else {
                $builder->andWhere($condition);
            }
        }
        return $this->fetchOne($builder);
    }

    /**
     * Возвращает запись по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * Пример расширения запроса через $callback
     * function(ReadQueryBuilderInterface $builder) {
     *       $builder->andWhere("object_type = :object_type", [':object_type' => 2]);
     * }
     *
     * @param array|callable $condition
     * @return array
     */
    public function oneByCondition($condition)
    {
        if ($condition instanceof ReadQueryBuilderInterface)
        {

            return $this->fetchOne($condition);
        }

        $builder = $this->getReadQueryBuilder();
        if (is_callable($condition)){
            call_user_func($condition, $builder);
        }else{
            $builder->andWhere($condition);
        }

        return $this->fetchOne($builder);
    }

    /**
     * Возвращает 1 запись
     *
     * @param QueryBuilderInterface $builder
     * @return array
     */
    protected function fetchOne(QueryBuilderInterface $builder)
    {
        $this->extendBuilder($builder);
        $sql = $builder->getSql();
        $params = $builder->getParams();
        $stmt = $this->buildPdoStatement($sql, $params);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает массив записей по идентификаторам
     *
     * @param array $ids
     *
     * Пример расширения запроса через $callback
     * function(ReadQueryBuilderInterface $builder) {
     *       $builder->andWhere("object_type = :object_type", [':object_type' => 2]);
     * }
     *
     * @param array|callable $condition

     * @return array
     */
    public function allByIds(array $ids, $condition = null)
    {
        $builder = $this->getReadQueryBuilder();
        $builder->andInCondition('id', $ids);
        if ($condition) {
            if (is_callable($condition)) {
                call_user_func($condition, $builder);
            } else {
                $builder->andWhere($condition);
            }
        }

        return $this->fetchAll($builder);
    }

    /**
     * Возвращает массив записей по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * Пример расширения запроса через $callback
     * function(ReadQueryBuilderInterface $builder) {
     *       $builder->andWhere("object_type = :object_type", [':object_type' => 2]);
     * }
     *
     * @param array|ReadConditionInterface|callable $condition
     * @return array
     */
    public function allByCondition($condition)
    {
        if ($condition instanceof ReadQueryBuilderInterface)
        {

            return $this->fetchAll($condition);
        }
        $builder = $this->getReadQueryBuilder();
        if (is_callable($condition)) {
            call_user_func($condition, $builder);
        }else if ($condition instanceof ReadConditionInterface){
            $builder->applyReadQuery($condition);
        }else{
            $builder->andWhere($condition);
        }

        return $this->fetchAll($builder);
    }

    /**
     * Возвращает массив записей
     *
     * @param QueryBuilderInterface $builder
     * @return array
     */
    protected function fetchAll(QueryBuilderInterface $builder)
    {
        $this->extendBuilder($builder);
        $sql = $builder->getSql();
        $params = $builder->getParams();
        $stmt = $this->buildPdoStatement($sql, $params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает PdoStatement
     *
     * @param $sql
     * @param $params
     * @return Statement
     */
    private function buildPdoStatement(string $sql, array $params = [])
    {
        $stmt = $this->getConnection()->prepare($sql);
        foreach ($params as $name => $value){
            $stmt->bindValue($name, $value);
        }
        $stmt->execute();

        return $stmt;
    }

    /**
     * Расширяет билдер
     * Если используется ReadQueryBuilder добавляет таблицу
     *
     * @param $builder
     */
    private function extendBuilder($builder)
    {
        if ($builder instanceof ReadQueryBuilderInterface) {
            $builder->from($this->getTableName());
            $builder->makeSelectSql();
        }
    }
}

