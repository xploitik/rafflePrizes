<?php

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Flash\Session as Flash;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Session\Adapter\Files as PhalconSession;
use RafflePrizes\infrastructure\session\Session;
use RafflePrizes\interfaces\infrastructure\session\SessionInterface;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\interfaces\services\userService\UserRepositoryInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\routes\RouterBuilder;
use RafflePrizes\plugins\SecurityPlugin;
use RafflePrizes\services\authService\AuthService;
use RafflePrizes\services\userService\repository\UserRepository;
use RafflePrizes\services\userService\UserService;

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

$di->setShared('dispatcher', function () use ($di) {
    /** @var \Phalcon\Events\Manager $evManager */
    $evManager = $di->getShared('eventsManager');

    $evManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin());

    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($evManager);

    return $dispatcher;
});

$di->setShared(SessionInterface::class, function () {
    $phalconSession = new PhalconSession();
    $phalconSession->start();

    return new Session($phalconSession);
});

$di->setShared('db', function() use ($di) {
    $options = $di->get('config');
    return new Mysql($options['db']);
});

$di->setShared('router', function () use ($di) {
    return RouterBuilder::build();
});

$di->setShared('config', function () {
    $configData = require APP_PATH . '/config/params.php';
    return $configData;
});

$di->set('flash', function () {
    return new Flash();
});

$di->set(UserServiceInterface::class, function () use ($di) {
    return new UserService($di->get(UserRepositoryInterface::class));
});

$di->set(UserRepositoryInterface::class, function () {
    return new UserRepository();
});

$di->set(AuthServiceInterface::class, function () use ($di) {
    return new AuthService($di->get(SessionInterface::class), $di->get(UserServiceInterface::class));
});

