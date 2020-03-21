<?php

namespace RafflePrizes\controllers;

use RafflePrizes\exceptions\NotFoundHttpException;

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
