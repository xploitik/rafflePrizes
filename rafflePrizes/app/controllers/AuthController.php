<?php

namespace RafflePrizes\controllers;

use RafflePrizes\forms\AuthForm;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\routes\RouterBuilder;
use RafflePrizes\utils\ErrorMap;

class AuthController extends BaseController
{
    public function onConstruct()
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);

        if ($authService->isAuthentication()) {
            $this->response->redirect(RouterBuilder::ROUTE_INDEX);
            $this->response->send();
            exit();
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function authAction()
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);

        $form = new AuthForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost())) {
                $email = $this->request->getPost('email', 'email');
                $password = $this->request->getPost('password');

                if ($authService->login($email, $password)) {
                    $this->response->redirect(RouterBuilder::ROUTE_INDEX);
                    $this->response->send();
                    exit();
                } else {
                    $this->flash->error(ErrorMap::AUTH_ERROR);
                }
            } else {
                $messages = $form->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
            }
        }

        $this->tag->setTitle("Розыгрыш призов / Авторизация");

        $this->view->setVars(['form' => $form]);
        $this->view->pick('auth/auth');
    }
}
