<?php
namespace Core\Validators;

use Core\Base\Validator;

/**
 * Class EmailValidator
 * @package Core\Validators
 * @author citizenzet <exgamer@live.ru>
 */
class EmailValidator extends Validator
{
    public function validate()
    {
        if (filter_var($this->value, FILTER_VALIDATE_EMAIL) === false ) {

            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return "Не email";
    }
}