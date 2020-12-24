<?php
require_once __DIR__ .'/../autoload.php';

$config = require __DIR__ .'/../Config/Main.php';
$app = new \Core\Base\App($config);

$app->run();