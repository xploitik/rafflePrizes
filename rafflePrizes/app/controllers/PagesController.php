<?php

namespace RafflePrizes\controllers;

use RafflePrizes\exceptions\NotFoundHttpException;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\interfaces\services\raffleService\RaffleServiceInterface;

class PagesController extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function homeAction()
    {
        $this->tag->setTitle("Розыгрыш призов");

        if ($this->request->isPost()) {
            /** @var AuthServiceInterface $authService */
            $authService = $this->di->get(AuthServiceInterface::class);
            $user = $authService->getCurrentUser();

            /** @var RaffleServiceInterface $raffleService */
            $raffleService = $this->di->get(RaffleServiceInterface::class);
            $prize = $raffleService->getRandomPrize();
            $prize->bindTo($user);

            /*
             * применение приза, то есть его активное действие (отправка курьеру, зачисление на счет и т.д.)
             * можно не делать сразу, в таком случае будет необходимо реализовать соответствующую логику
             * здесь применяется сразу
             */
            $prize->apply($user);

            $this->view->setVar('prize', $prize);
            $this->view->pick('pages/won');

            return;
        }

        $this->view->pick('pages/home');
    }

    public function notFoundAction(): void
    {
        throw new NotFoundHttpException();
    }
}
