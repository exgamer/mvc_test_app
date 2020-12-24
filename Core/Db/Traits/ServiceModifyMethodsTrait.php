<?php
namespace Core\Db\Traits;

use Core\Base\DataValidationErrors;

/**
 * Trait ServiceModifyMethodsTrait
 * @package Services\Db\Traits
 */
trait ServiceModifyMethodsTrait
{
    /**
     * @param $data
     * @return int
     */
    public function persist( array $data) : int
    {
        $data = $this->validateInsertData($data);
        if ($data instanceof DataValidationErrors) {

            return $data;
        }
        $this->prePersist($data);
        $this->prePersistExternal($data);
        $id = $this->getStorage()->persist($data);
        $this->postPersist($data);
        $this->postPersistExternal($data);

        return $id;
    }

    /**
     * @param $data
     * @return array
     */
    protected function validateInsertData(array $data)
    {

        return $this->validateData($data);
    }

    /**
     * @param $data
     */
    protected function prePersist(array &$data){}

    /**
     * @param $data
     */
    protected function postPersist(array &$data){}

    /**
     * @param $data
     */
    protected function prePersistExternal(array &$data){}

    /**
     * @param $data
     */
    protected function postPersistExternal(array &$data)
    {
    }

    /**
     * @param int $id
     * @param $data
     * @return array
     */
    public function updateById(int $id, array $data)
    {
        $oldData = $this->getOldData(['id' => $id]);
        $changedData = $this->getChangedData($data, $oldData);
        $data = $this->validateUpdateData($data);
        if ($data instanceof DataValidationErrors) {

            return $data;
        }
        $this->preUpdate($id, $data, $oldData, $changedData);
        $this->preUpdateExternal($id, $data, $oldData, $changedData);
        $this->getStorage()->updateById($id, $data);
        $this->postUpdate($id, $data, $oldData, $changedData);
        $this->postUpdateExternal($id, $data, $oldData, $changedData);
    }

    /**
     * @param array $params
     * @param $condition
     * @return bool
     */
    public function update(array $params, $condition) : bool
    {
        return $this->getStorage()->update($params, $condition);
    }

    /**
     * @param $data
     * @return array
     */
    protected function validateUpdateData(array $data)
    {

        return $this->validateData($data);
    }

    /**
     * Метод для дополнительной обработки текущей сущности перед обновлением
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function preUpdate(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки текущей сущности после обновления
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function postUpdate(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки связанных сущностей перед обновлением
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function preUpdateExternal(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки связанных сущностей после обновления
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function postUpdateExternal(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * @param int $id
     */
    public function removeById(int $id)
    {
        $this->preRemove($id);
        $this->preRemoveExternal($id);
        $this->getStorage()->removeById($id);
        $this->postRemove($id);
        $this->postRemoveExternal($id);
    }

    /**
     * @param $condition
     * @return bool
     */
    public function remove($condition) : bool
    {
        return $this->getStorage()->delete($condition);
    }

    /**
     * Метод для дополнительной обработки текущей сущности перед удалением
     *
     * @param int $id
     */
    public function preRemove(int $id){}

    /**
     * Метод для дополнительной обработки текущей сущности после удаления
     *
     * @param int $id
     */
    public function postRemove(int $id){}

    /**
     * Метод для дополнительной обработки связанных сущностей перед удалением
     *
     * @param int $id
     */
    public function preRemoveExternal(int $id){}

    /**
     * Метод для дополнительной обработки связанных сущностей после удаления
     *
     * @param int $id
     */
    public function postRemoveExternal(int $id){}


    public function validateData(array $data)
    {
        return $data;
    }

    /**
     * Возвращает старую запись
     *
     * @param array $condition
     * @return array
     */
    protected function getOldData(array $condition)
    {

        return [];
    }

    /**
     * Возвращает массив с измененными данными
     *
     * @param array $data
     * @param array $oldData
     *
     * Возвращает массив где значение массив данных где 1 элемент старове значение второй новое
     * [
     *      0 => 1,
     *      1 => 2
     * ]
     *
     * @return array
     */
    protected function getChangedData(array $data, array $oldData)
    {
        $changedData = [];
        foreach ($oldData as $attr=>$value){
            if (! isset($data[$attr])){
                continue;
            }
            if ($value == $data[$attr]){
                continue;
            }
            $changedData[$attr] = [
                $value,
                $data[$attr]
            ];
        }

        return $changedData;
    }

    /**
     * Проверка изменились ли данные
     * @param $key
     * @param $changedData
     * @return bool
     */
    protected function isDataChanged($key, $changedData)
    {
        if (isset($changedData[$key])){

            return true;
        }

        return false;
    }

    /**
     * Возвращает копию даннных
     *
     * @param array $data
     * @param array $newData - данные для обновления
     * @param array $excludeKeys - данные которые надо исключить
     * @return array
     */
    public function getClone(array $data, array $newData = [], array $excludeKeys = [])
    {
        foreach ($excludeKeys as $key){
            if (! isset($data[$key])){
                continue;
            }
            unset($data[$key]);
        }
        foreach ($newData as $key => $value){
            if (! isset($data[$key])){
                continue;
            }
            $data[$key] = $value;
        }

        return $data;
    }
}

