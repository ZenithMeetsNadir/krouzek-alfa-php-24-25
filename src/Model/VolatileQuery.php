<?php

namespace App\Model;

use App\Service\Router;

class VolatileQuery {

    protected array $redirectOrigins = [];
    protected string $route = Router::DEFAULT_CONTROLLER;

    public function __construct() {
        $this->setRedirectOrigin(new AuthOrigin());
    }

    public function distributeLabeledParams(array $params): void {
        foreach ($this->getRedirectOrigins() as $originName => $redirectOrigin) {
            $originLabeledParams = array_filter($params, function ($paramName) use ($redirectOrigin) {
                return $redirectOrigin->isLabeledParam($paramName);
            }, ARRAY_FILTER_USE_KEY);

            $origin = $params[$redirectOrigin->getRedirectName()];
            if ($origin)
                $redirectOrigin->setOrigin($origin);

            $redirectOrigin->unlabelParams($originLabeledParams);
        }
    }

    public function extractRoute(array $query): void {
        $route = $query['route'];
        if ($route)
            $this->setRoute($route);
    }

    public function getRedirectOrigins(): array {
        return $this->redirectOrigins;
    }

    public function setRedirectOrigin(RedirectOrigin $redirectOrigin): VolatileQuery {
        $this->redirectOrigins[$redirectOrigin->getRedirectName()] = $redirectOrigin;
        return $this;
    }

    public function getRoute(): string {
        return $this->route;
    }

    public function setRoute(string $route): void {
        $this->route = $route;
    }
}