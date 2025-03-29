<?php

namespace App\Service;

use App\DI;
use App\Model\AuthOrigin;
use App\Model\RedirectOrigin;
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

    public function extractQuery(): void {
        $query = $_GET;
        $this->volatileQuery->distributeLabeledParams($query);
        $this->volatileQuery->extractRoute($query);
    }

    #[NoReturn] public function redirect(?string $destination = null, array $params = []): void {
        $redirectUrl = $this->linkGenerator->generateLink($destination, $params);
        header('Location: ' . $redirectUrl);

        exit();
    }

    #[NoReturn] public function redirectCreateOrigins(?string $destination, array $origins, array $keepOriginNames = [], array $params = []): void {
        $originNames = [];
        foreach ($origins as $origin) {
            $this->volatileQuery->setRedirectOrigin($origin);
            $originNames[] = $origin->getRedirectName();
        }

        $originNames = array_merge($originNames, $keepOriginNames);

        $this->redirectKeepOrigins($destination, $originNames, $params);
    }

    #[NoReturn] public function redirectKeepOrigins(?string $destination, array $originNames = [AuthOrigin::NAME], array $params = []): void {
        $origins = $this->queryKeepOrigins($originNames, $params);

        $this->redirect($destination, $origins);
    }

    #[NoReturn] public function redirectBack(?string $originName = AuthOrigin::NAME, array $keepOriginNames = []): void {
        $origin = $this->getVolatileQuery()->getRedirectOrigins()[$originName];
        $this->redirectKeepOrigins($origin->getOrigin(), $keepOriginNames, $origin->getParams());
    }

    public function queryKeepOrigins(array $originNames = [AuthOrigin::NAME], array $params = []): array {
        foreach ($originNames as $originName) {
            $origin = $this->volatileQuery->getRedirectOrigins()[$originName];
            $params[$origin->getRedirectName()] = $origin->getOrigin();
            $params = array_merge($params, $origin->labelParams());
        }

        return $params;
    }

    public function getVolatileQuery(): VolatileQuery {
        return $this->volatileQuery;
    }

    public function setVolatileQuery(VolatileQuery $volatileQuery): Redirect {
        $this->volatileQuery = $volatileQuery;
        return $this;
    }
}