<?php

namespace Core\Helpers;

use ReflectionClass;
use ReflectionException;

/**
 * Class AppHelper
 * @package App\Core\Helpers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AppHelper
{
    /**
     * Создает обьект из конфига приложения
     *
     * @param $config
     * @return object
     * @throws ReflectionException
     */
    public static function createObjectFromConfig($config)
    {
        $className = $config['class'] ?? null;
        unset($config['class']);

        return static::createObject($className, $config);
    }

    /**
     * Создание обьекта
     *
     * @param $className
     * @param $arguments
     * @return object
     * @throws ReflectionException
     */
    public static function createObject($className, $arguments)
    {
        $reflector = new ReflectionClass($className);
        if (!empty($arguments)){
            $arguments = [
                $arguments
            ];
        }

        return $reflector->newInstanceArgs($arguments);
    }
}