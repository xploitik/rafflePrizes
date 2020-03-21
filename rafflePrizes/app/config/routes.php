<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

$router = new \Phalcon\Mvc\Router();
$router->clear();
$router->removeExtraSlashes(true);
$router->setDefaults(['namespace' => 'RafflePrizes\controllers']);

$router->notFound([
    'controller' => 'Pages',
    'action' => 'notFound',
]);

$router->add('/', ["controller" => "Pages", "action" => "home"]);

return $router;