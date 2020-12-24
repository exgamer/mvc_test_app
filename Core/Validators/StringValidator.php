<?php
namespace Core\Validators;

use Core\Base\Validator;

/**
 * Class StringValidator
 * @package Core\Validators
 * @author citizenzet <exgamer@live.ru>
 */
class StringValidator extends Validator
{
    public function validate()
    {
        if (! is_string($this->value)) {

            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return "Не строка";
    }
}