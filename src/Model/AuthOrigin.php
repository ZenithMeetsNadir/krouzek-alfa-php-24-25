<?php

namespace App\Model;

use App\DI;

class AuthOrigin extends RedirectOrigin {

    public const NAME = 'authOrigin';

    protected string $redirectName = self::NAME;

    public function __construct(?string $origin = null, array $params = []){
        $this->origin = $origin;
        $this->params = $params;
    }

    public static function canCreateAuthOrigin(string $route): bool {
        return !in_array($route, DI::getInstance()->getSingletonService('originInteraction')->disallowAuthOriginCreation);
    }
}