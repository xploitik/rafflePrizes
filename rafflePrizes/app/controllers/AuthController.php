<?php

namespace RafflePrizes\controllers;

use RafflePrizes\forms\AuthForm;
use RafflePrizes\forms\RegisterForm;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\routes\RouterBuilder;
use RafflePrizes\utils\ErrorMap;

class AuthController extends BaseController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function loginAction()
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);
        if ($authService->isAuthentication()) {
            $this->response->redirect(RouterBuilder::ROUTE_INDEX);
            $this->response->send();
            exit();
        }

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

    public function logoutAction()
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);
        $authService->logout();

        $this->response->redirect(RouterBuilder::ROUTE_INDEX);
        $this->response->send();
        exit();
    }

    public function registerAction()
    {
        /** @var AuthServiceInterface $authService */
        $authService = $this->di->get(AuthServiceInterface::class);
        if ($authService->isAuthentication()) {
            $this->response->redirect(RouterBuilder::ROUTE_INDEX);
            $this->response->send();
            exit();
        }

        /** @var UserServiceInterface $userService */
        $userService = $this->di->get(UserServiceInterface::class);

        try {
            $form = new RegisterForm();
            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost())) {

                    //TODO: DTO
                    $registerData = [
                        'name' => $this->request->getPost('name', 'string'),
                        'email' => $this->request->getPost('email', 'email'),
                        'password' => $this->request->getPost('password'),
                        'address' => $this->request->getPost('address', 'string'),
                    ];

                    if ($userService->add($registerData)) {
                        $this->flash->success(ErrorMap::REGISTER_SUCCESS);
                        $this->response->redirect(RouterBuilder::ROUTE_INDEX);
                        $this->response->send();
                        exit();
                    } else {
                        $this->flash->error(ErrorMap::REGISTER_ERROR);
                    }
                } else {
                    $messages = $form->getMessages();
                    foreach ($messages as $message) {
                        $this->flash->error($message);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }

        $this->tag->setTitle("Розыгрыш призов / Регистрация");

        $this->view->setVars(['form' => $form]);
        $this->view->pick('auth/register');
    }
}
