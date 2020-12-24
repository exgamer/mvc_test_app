<?php

namespace Core\Base;

use Core\Helpers\AppHelper;
use Exception;
use Models\User;
use ReflectionClass;
use ReflectionException;

/**
 * класс приложения
 *
 * Class App
 * @package App\Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class App extends BaseObject
{
    /**
     * неимспеис контроллеров
     *
     * @var string
     */
    public $controllerNameSpace = 'Controllers';
    /**
     * дефолтный роут
     *
     * @var string
     */
    public $defaultRoute = "site/index";

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * типа контейнер
     *
     * @var array
     */
    private $_container = [];

    /**
     * Конфиг компонентов
     *
     * @var array
     */
    public $components;



    /**
     * Запуск приложения
     */
    public function run()
    {
        $controllerName = $this->getRouter()->getControllerName();
        $actionName = $this->getRouter()->getActionName();
        $queryParams = $this->getRequest()->getQueryParams();
        if (! $controllerName || ! $actionName) {
            $default = explode('/', $this->defaultRoute);
            if (! $actionName) {
                $actionName = $default[1];
            }

            if (! $controllerName) {
                $controllerName = $default[0];
            }
        }

        echo $this->runAction($controllerName, $actionName, $queryParams);
    }


    /**
     * Запуск экшена контроллера
     *
     * @param $controllerName
     * @param $actionName
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public function runAction($controllerName, $actionName, $params)
    {
        $controllerClass = $this->controllerNameSpace . "\\" . ucfirst($controllerName) . "Controller";
        $actionName = "action" . ucfirst($actionName);
        $this->initController($controllerClass, ['app' => $this]);
        if (! method_exists($this->controller, $actionName)) {
            throw new Exception("not found");
        }

        // @TODO тут важен порядок параметров экшена. сделано очень по простому для примера
        return call_user_func_array([$this->getController(), $actionName], $params);
    }

    /**
     * Возвращает коннект к ДБ
     *
     * @return Db
     * @throws ReflectionException
     */
    public function getDb()
    {
        return $this->get('db');
    }

    /**
     * Возвращает роутер
     *
     * @return Router
     * @throws ReflectionException
     */
    public function getRouter()
    {
        return $this->get('router');
    }

    /**
     * Возвращает запрос
     *
     * @return Request
     * @throws ReflectionException
     */
    public function getRequest()
    {
        return $this->get('request');
    }

    /**
     *
     *
     * @return User
     * @throws ReflectionException
     */
    public function getUser()
    {
        return $this->get('user');
    }

    /**
     * инит контроллера
     *
     * @param $controllerClass
     * @param array $params
     * @throws ReflectionException
     */
    protected function initController($controllerClass, $params = [])
    {
        $this->controller = AppHelper::createObject($controllerClass, $params);
    }

    /**
     * @return Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Возвращает компонент
     *
     * @param $id
     * @return ApplicationComponent
     * @throws ReflectionException
     */
    public function get($id)
    {
        if (isset($this->_container[$id])) {
            return $this->_container[$id];
        }

        if (! isset($this->components[$id])) {
            throw new Exception("Unknown component ID: $id");
        }

        $config = $this->components[$id];
        $config['app'] = $this;

        return $this->_container[$id] = AppHelper::createObjectFromConfig($config);
    }
}