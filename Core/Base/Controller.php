<?php

namespace Core\Base;

/**
 * Class Controller
 * @package App\Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Controller extends ApplicationComponent
{
    /**
     * рендер вьюх
     *
     * @param $viewName
     * @param array $params
     * @return false|string
     */
    public function render ($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();

        return $body;
    }

    public function redirect($route) {
//        $url = "http://" . $_SERVER[HTTP_HOST] . $route;
        ob_start();
        header('Location: '.$route);
        ob_end_flush();
        die();
    }
}