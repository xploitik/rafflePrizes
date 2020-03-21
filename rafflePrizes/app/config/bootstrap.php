<?php

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;

/** @var \Phalcon\DiInterface $di */

$di->setShared('view', function () {
    $view = new View();
    $view->setDI($this);
    $view->setViewsDir(APP_PATH . '/views/desktop/');

    $view->registerEngines([
        '.phtml' => PhpEngine::class
    ]);

    return $view;
});

$di->set('db', function() use ($di) {
    $options = $di->get('config');
    return new Mysql($options['db']);
});

$di->setShared('router', function () use ($di) {
    return (require APP_PATH . '/config/routes.php');
});

$di->setShared('config', function () {
    $configData = require APP_PATH . '/config/params.php';
    return $configData;
});