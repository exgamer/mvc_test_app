<?php
namespace Core\Db\Traits;

/**
 * Trait ServiceReadMethodsTrait
 * @package Services\Db\Traits
 */
trait ServiceReadMethodsTrait
{
    /**
     * Возвращает одну запись по id
     * @param int $id
     *
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param  $condition
     * @return array
     */
    public function oneById(int $id, $condition = null) : array
    {

        return $this->getStorage()->oneById($id, $condition);
    }

    /**
     * Возвращает запись по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param $condition
     * @return array
     */
    public function oneByCondition($condition) : array
    {

        return $this->getStorage()->oneByCondition($condition);
    }

    /**
     * Возвращает массив записей по идентификаторам
     *
     * @param array $ids
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param $condition

     * @return array
     */
    public function allByIds(array $ids, $condition = null) : array
    {

        return $this->getStorage()->allByIds($ids, $condition);
    }

    /**
     * Возвращает массив записей по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     *
     * @param $condition
     * @return array
     */
    public function allByCondition($condition) :array
    {

        return $this->getStorage()->allByCondition($condition);
    }

    public function getCount()
    {

        return $this->getStorage()->getCount();
    }
}

