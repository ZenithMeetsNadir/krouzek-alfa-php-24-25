<?php

namespace App\Model;

class AuthOrigin extends RedirectOrigin {

    public const NAME = 'authOrigin';

    protected string $redirectName = self::NAME;

    public function __construct(?string $origin = null, array $params = []){
        $this->origin = $origin;
        $this->params = $params;
    }
}