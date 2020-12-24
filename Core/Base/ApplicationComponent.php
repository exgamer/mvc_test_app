<?php
namespace Core\Base;

/**
 * Класс для компонентов приложения чтобы получить доступ к компонетам:)
 *
 * Class ApplicationComponent
 * @package Core\Base
 * @author citizenzet <exgamer@live.ru>
 */
abstract class ApplicationComponent extends BaseObject
{
    /**
     * @var App
     */
    public $app;

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }
}