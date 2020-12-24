<?php
namespace Core\Base;

/**
 * Class Validator
 * @package Core\Base
 * @author citizenzet <exgamer@live.ru>
 */
abstract class Validator extends BaseObject
{
    public $value;
    public $required = 0;

    public abstract function validate();

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return "wrong data type";
    }
}