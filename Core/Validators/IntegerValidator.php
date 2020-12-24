<?php
namespace Core\Validators;

use Core\Base\Validator;

/**
 * Class IntegerValidator
 * @package Core\Validators
 * @author citizenzet <exgamer@live.ru>
 */
class IntegerValidator extends Validator
{
    public function validate()
    {
        if (filter_var($this->value, FILTER_VALIDATE_INT) === false ) {

            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return "Не число";
    }
}