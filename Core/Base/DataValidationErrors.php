<?php
namespace Core\Base;

/**
 * Class DataValidationErrors
 * @package Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class DataValidationErrors extends BaseObject
{
    private $_errors = [];

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->_errors = $errors;
    }
}
