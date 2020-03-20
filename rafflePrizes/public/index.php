<?php

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app/');

try {

    require_once BASE_PATH . '/vendor/autoload.php';

    $di = new \Phalcon\Di\FactoryDefault();
    require APP_PATH . '/config/bootstrap.php';

    $aplication = new \Phalcon\Mvc\Application($di);

    $response = $aplication->handle()->getContent();
    echo $response;
} catch (\throwable $e) {

    //TODO: add logger
    var_dump([
        'detail' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
        'trace' => $e->getTrace(),
    ]);

    exit();
}