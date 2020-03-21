<?php

namespace RafflePrizes\plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\RouteInterface;
use Phalcon\Mvc\User\Plugin;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\routes\AuthRoute;

class SecurityPlugin extends Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);
        if ($authService->isAuthentication()) {
            return;
        }

        /** @var Router $router */
        $router = $this->di->get('router');

        /** @var RouteInterface $route */
        $route = $router->getMatchedRoute();
        if ($route->getName() !== AuthRoute::ROUTE_AUTH && $route->getName() !== AuthRoute::ROUTE_REGISTER) {
            $this->response->redirect(AuthRoute::ROUTE_AUTH);
            $this->response->send();
        }
    }
}
