<?php

namespace RafflePrizes\routes;

use Phalcon\Mvc\Router\Group as RouterGroup;

class AuthRoute extends RouterGroup
{
    const ROUTE_REGISTER = '/register';
    const ROUTE_AUTH = '/auth';

    public function initialize()
    {
        $this->add(self::ROUTE_REGISTER, [
            'controller' => 'Auth',
            'action' => 'register',
        ])->setName(self::ROUTE_REGISTER);

        $this->add(self::ROUTE_AUTH, [
            'controller' => 'Auth',
            'action' => 'auth',
        ])->setName(self::ROUTE_AUTH);
    }
}
