<?php

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Flash\Session as Flash;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Session\Adapter\Files as PhalconSession;
use RafflePrizes\infrastructure\session\Session;
use RafflePrizes\interfaces\infrastructure\session\SessionInterface;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\interfaces\services\deliveryService\DeliveryServiceInterface;
use RafflePrizes\interfaces\services\raffleService\RaffleServiceInterface;
use RafflePrizes\interfaces\services\userService\UserRepositoryInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\interfaces\services\thingsService\ThingsServiceInterface;
use RafflePrizes\routes\RouterBuilder;
use RafflePrizes\plugins\SecurityPlugin;
use RafflePrizes\services\authService\AuthService;
use RafflePrizes\services\deliveryService\DeliveryService;
use RafflePrizes\services\raffleService\factory\LoyaltyPrizeFactory;
use RafflePrizes\services\raffleService\factory\MoneyPrizeFactory;
use RafflePrizes\services\raffleService\factory\PhysicalPrizeFactory;
use RafflePrizes\services\raffleService\RaffleService;
use RafflePrizes\services\userService\repository\UserRepository;
use RafflePrizes\services\userService\UserService;
use RafflePrizes\services\thingsService\ThingsService;

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

$di->set(DeliveryServiceInterface::class, function () use ($di) {
    return new DeliveryService();
});

$di->set(ThingsServiceInterface::class, function () use ($di) {
    return new ThingsService();
});

$di->set(RaffleServiceInterface::class, function () use ($di) {

    $options = $di->get('config');
    $restrictions = $options['raffle']['restrictions'];
    $settings = $options['raffle']['settings'];

    $factories = [];
    $factories[] = new MoneyPrizeFactory(
        $di->get(UserServiceInterface::class),
        $restrictions['money']['min'],
        $restrictions['money']['max']
    );
    $factories[] = new LoyaltyPrizeFactory(
        $di->get(UserServiceInterface::class),
        $restrictions['loyalty']['min'],
        $restrictions['loyalty']['max'],
        $settings['loyalty']['source']
    );

    /** @var ThingsServiceInterface $thingsService */
    $thingsService = $di->get(ThingsServiceInterface::class);
    $factories[] = new PhysicalPrizeFactory(
        $di->get(DeliveryServiceInterface::class),
        $thingsService->getAll()
    );

    return new RaffleService($factories);
});



