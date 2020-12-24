<?php

namespace Core\Base;

/**
 * очень простой роутер
 *
 * Class Router
 * @package App\Core\Controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Router extends ApplicationComponent
{
    /**
     * Возвращает название контроллера
     *
     * @return string|null
     * @throws \ReflectionException
     */
    public function getControllerName()
    {
        $routeArray = $this->getApp()->getRequest()->getRouteArray();

        return $routeArray[0] ?? null;
    }

    /**
     * Возвращает название экшена
     *
     * @return string|null
     * @throws \ReflectionException
     */
    public function getActionName()
    {
        $routeArray = $this->getApp()->getRequest()->getRouteArray();

        return $routeArray[1] ?? null;
    }
}