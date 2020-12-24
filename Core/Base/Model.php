<?php
namespace Core\Base;

use Core\Helpers\AppHelper;
use Core\Validators\StringValidator;

/**
 * Class Model
 * @package Core\Base
 * @author citizenzet <exgamer@live.ru>
 */
abstract class Model extends BaseObject
{
    protected $_errors = [];

    /**
     * правила валидации
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Загружает данные в модель
     *
     * @param array $data
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Валидация данных
     */
    public function validate()
    {
        $result = true;
        $rules = $this->rules();
        if (! $rules) {

            return false;
        }

        foreach ($rules as $attr => $data) {
            $data['value'] = $this->{$attr};
            $validator = AppHelper::createObjectFromConfig($data);
            if ($validator->required == 1 && ! $validator->value) {
                $this->_errors[$attr] = "Не заполнено";
            }

            if ($validator instanceof StringValidator) {
                $this->{$attr} = htmlspecialchars($this->{$attr}, null, null, false);
                $this->{$attr} = strip_tags($this->{$attr});
            }

            if (! $validator->validate()) {
                $result = false;
                $this->_errors[$attr] = $validator->getErrorMessage();
            }
        }

        return $result;
    }

    /**
     * ошибки валидации
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    public function hasError($attr)
    {
        return isset($this->_errors[$attr]) ? true : false ;
    }

    public function getError($attr)
    {
        return $this->_errors[$attr] ?? null ;
    }

    public function getValidData()
    {
        $rules = $this->rules();
        $attrs = array_unique(array_keys($rules));
        $data = [];
        foreach ($attrs as $attr) {
            $data[$attr] = $this->{$attr};
        }

        return $data;
    }
}