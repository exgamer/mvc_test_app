<?php
namespace Models;

use Core\Base\Model;
use Core\Validators\StringValidator;

/**
 * Class User
 * @package Models
 * @author citizenzet <exgamer@live.ru>
 */
class User extends Model
{
    public $is_admin;
    public $login;
    public $password;

    public function rules()
    {
        return [
            'login' => [
                'class' => StringValidator::class,
                'required' => 1
            ],
            'password' => [
                'class' => StringValidator::class,
                'required' => 1
            ],
        ];
    }

    public function login()
    {
        if ($this->login == 'admin' && $this->password == '123')  {
            setcookie('is_admin', 1, time() + (86400 * 30), "/");
            return true;
        }

        if ($this->login != 'admin')  {
            $this->_errors['login'] = "Неверный логин";
        }

        if ($this->password != '123')  {
            $this->_errors['password'] = "Неверный пароль";
        }

        return false;
    }

    public function logout()
    {
        setcookie('is_admin', null, -100, "/"); // 86400 = 1 day
    }

    public function isAdmin()
    {
        if(!isset($_COOKIE['is_admin'])) {
            return false;
        }

        return $_COOKIE['is_admin'];
    }
}