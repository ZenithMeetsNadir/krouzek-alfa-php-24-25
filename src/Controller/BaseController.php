<?php

namespace App\Controller;

use App\DI;
use App\Model\AuthOrigin;
use App\Model\RedirectOrigin;
use App\Service\Message;
use App\Service\Redirect;
use App\Service\Router;
use App\View\View;
use JetBrains\PhpStorm\NoReturn;
use Tracy\Debugger;

abstract class BaseController {

    public const HOME = 'home/index';

    public string $defaultAction = 'index';
    protected View $view;
    protected DI $di;
    protected Redirect $redirect;
    protected Router $router;
    protected Message $message;

    public function __construct() {
        $this->view = new View();
        $this->di = DI::getInstance();
        $this->redirect = $this->di->getSingletonService('redirect');
        $this->router = $this->di->getSingletonService('router');
        $this->message = $this->di->getSingletonService('message');
    }

    public function renderView(array $data = []): void {
        $route = $this->redirect->getVolatileQuery()->getRoute();
        $fullRoute = $this->router->getFullRoute();

        $keepOrigins = $this->redirect->queryKeepOrigins();
        $data['keepOrigins'] = $keepOrigins;

        $createOrigins = $this->redirect->queryCreateAuthOrigin();
        $data['createOrigins'] = $createOrigins;

        $data = array_merge($data, $_GET);

        $this->view->render($fullRoute, $data);
    }

    public function extractQuery(): void {
        $this->redirect->extractQuery();
    }

    public function requireAuth(): void {
        if (!$_SESSION['user']) {
            $route = $this->redirect->getVolatileQuery()->getRoute();
            $this->redirect->redirectCreateOrigins(
                'sign/in',
                [new AuthOrigin($route)],
                params: ['message_id' => 'auth_required', 'message_arg0' => $route]
            );
        }
    }

    protected function isAuth(): void {

    }

    public function __toString() {
        return get_class($this);
    }
}