<?php

namespace RafflePrizes\routes;

use Phalcon\Mvc\RouterInterface;

class RouterBuilder
{
    public const ROUTE_INDEX = '/';

    /** @var RouterInterface|null */
    private static $router;

    /**
     * @return RouterInterface
     */
    public static function build()
    {
        if (isset(self::$router)) {
            return self::$router;
        }

        $router = new \Phalcon\Mvc\Router();
        $router->clear();
        $router->removeExtraSlashes(true);
        $router->setDefaults(['namespace' => 'RafflePrizes\controllers']);

        $router->notFound([
            'controller' => 'Pages',
            'action' => 'notFound',
        ]);

        $router->add(
            self::ROUTE_INDEX,
            [
                "controller" => "Pages",
                "action" => "home"
            ]
        )->setName(self::ROUTE_INDEX);

        $router->mount(new AuthRoute());

        return self::$router = $router;
    }
}
