<?php

namespace App\Controller;

use App\DI;
use App\Service\LinkGenerator;
use App\View\View;
use JetBrains\PhpStorm\NoReturn;

abstract class BaseController {

    public string $defaultAction = 'index';
    protected View $view;
    protected LinkGenerator $linkGenerator;
    protected DI $di;

    public function __construct() {
        $this->view = new View();
        $this->di = DI::getInstance();
        $this->linkGenerator = $this->di->getSingletonService('linkGenerator');
    }

    public function __toString() {
        return get_class($this);
    }

    #[NoReturn] public function redirect(string $destination = 'home/index', array $params = []): void {
        $url = $this->linkGenerator->generateLink($destination, $params);
        header("Location: $url");

        exit();
    }
}