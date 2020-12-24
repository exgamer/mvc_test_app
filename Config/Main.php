<?php

return [
    'controllerNameSpace' => 'Controllers',
    'defaultRoute' => 'site/index',
    'components' => [
        'db' => [
            'class' => 'Core\Base\Db',
            'dsn' => 'mysql:host=db;dbname=mvc_test',
            'username' => 'root',
            'password' => '123',
        ],
        'router' => [
            'class' => 'Core\Base\Router',
        ],
        'request' => [
            'class' => 'Core\Base\Request',
        ],
        'user' => [
            'class' => 'Models\User',
        ],
        'taskService' => [
            'class' => 'Services\TaskService',
            'storageConfig' => [
                'class' => 'Storages\TaskStorage',
            ]
        ]
    ]
];