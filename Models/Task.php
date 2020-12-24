<?php
namespace Models;

use Core\Base\Model;
use Core\Validators\EmailValidator;
use Core\Validators\IntegerValidator;
use Core\Validators\StringValidator;

/**
 * Class Task
 * @package Core\Base
 * @author citizenzet <exgamer@live.ru>
 */
class Task extends Model
{
    public $id;
    public $username;
    public $email;
    public $text;
    public $done = 0;

    public function rules()
    {
        return [
            'username' => [
                'class' => StringValidator::class,
                'required' => 1
            ],
            'text' => [
                'class' => StringValidator::class,
                'required' => 1
            ],
            'email' => [
                'class' => EmailValidator::class,
                'required' => 1
            ],
            'done' => [
                'class' => IntegerValidator::class,
            ],
        ];
    }
}