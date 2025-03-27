<?php

namespace App\Service;

use App\DI;
use App\Model\VolatileQuery;
use JetBrains\PhpStorm\NoReturn;

final class Redirect {

    private VolatileQuery $volatileQuery;
    private DI $di;
    private LinkGenerator $linkGenerator;

    public function __construct() {
        $this->di = DI::getInstance();
        $this->linkGenerator = $this->di->getSingletonService('linkGenerator');
    }

    #[NoReturn] public function redirect(string $destination, array $params = []): void {
        $redirectUrl = $this->linkGenerator->generateLink($destination, $params);
        header('Location: ' . $redirectUrl);

        exit();
    }

    #[NoReturn] public function redirectKeepOrigin(string $destination, array $params = []): void {
        // TODO implement origin preservation
    }

    #[NoReturn] public function redirectBack(): void {
        $origin = $this->getVolatileQuery()->getUnauthorizedAccessOrigin();
        $this->redirect($origin->getOrigin(), $origin->getParams());
    }

    public function getVolatileQuery(): VolatileQuery {
        return $this->volatileQuery;
    }

    public function setVolatileQuery(VolatileQuery $volatileQuery): Redirect {
        $this->volatileQuery = $volatileQuery;
        return $this;
    }
}