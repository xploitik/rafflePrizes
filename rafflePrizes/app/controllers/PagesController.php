<?php

namespace RafflePrizes\controllers;

use RafflePrizes\exceptions\NotFoundHttpException;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;

class PagesController extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function homeAction()
    {
        $this->tag->setTitle("Розыгрыш призов");

        $this->view->pick('pages/home');
    }

    public function notFoundAction(): void
    {
        throw new NotFoundHttpException();
    }
}
