<?php

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