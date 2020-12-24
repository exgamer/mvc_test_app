<?php
namespace Core\Base;

/**
 * Базовый обьект
 *
 * Class BaseObject
 * @package App\Core\Base
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class BaseObject
{
    public function __construct($config = [])
    {
        if (!empty($config)) {
            foreach ($config as $name => $value) {
                $this->{$name} = $value;
            }
        }
        $this->init();
    }

    public function init(){}
}