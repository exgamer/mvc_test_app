<?php

namespace Core\Base;

/**
 * очеьн простой реквест
 *
 * Class Request
 * @package Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Request extends ApplicationComponent
{
    /**
     * для примера обрабатываются url типа /site/index?id=1
     * никаких модулей и т.п.
     * для задания сойдет
     *
     * Возвращает роут из REQUEST_URI
     *
     * @return array
     */
    public function getRouteArray()
    {
        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }

        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        $result[0] = array_shift($route);
        $result[1] = array_shift($route);

        return $result;
    }

    /**
     * Возвращает параметры запроса из REQUEST_URI
     *
     * @return array
     */
    public function getQueryParams()
    {
        $params = [];
        $queryString = $_SERVER['QUERY_STRING'];
        if (! $queryString) {
            return $params;
        }

        $queryStringArray = explode('&', $queryString);
        foreach ($queryStringArray as $element) {
            $elementArr = explode('=', $element);
            $params[$elementArr[0]] = $elementArr[1];
        }


        return $params;
    }

    /**
     * Вoзвращает POST
     *
     * @return []
     */
    public function getPost()
    {
        if (! empty($_POST) ) {
            return $_POST;
        }

        return [];
    }
}