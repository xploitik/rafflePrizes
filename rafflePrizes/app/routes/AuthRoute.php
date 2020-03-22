<?php

namespace RafflePrizes\routes;

use Phalcon\Mvc\Router\Group as RouterGroup;

class AuthRoute extends RouterGroup
{
    const ROUTE_REGISTER = '/register';
    const ROUTE_AUTH = '/login';
    const ROUTE_LOGOUT = '/logout';

    public function initialize()
    {
        $this->add(self::ROUTE_REGISTER, [
            'controller' => 'Auth',
            'action' => 'register',
        ])->setName(self::ROUTE_REGISTER);

        $this->add(self::ROUTE_AUTH, [
            'controller' => 'Auth',
            'action' => 'login',
        ])->setName(self::ROUTE_AUTH);

        $this->add(self::ROUTE_LOGOUT, [
            'controller' => 'Auth',
            'action' => 'logout',
        ])->setName(self::ROUTE_LOGOUT);
    }
}
