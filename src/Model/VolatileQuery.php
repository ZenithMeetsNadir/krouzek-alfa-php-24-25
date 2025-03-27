<?php

namespace App\Model;

use App\DI;
use App\Service\LinkGenerator;

class VolatileQuery {

    protected RedirectOrigin $unauthorizedAccessOrigin;

    public function getUnauthorizedAccessOrigin(): RedirectOrigin {
        return $this->unauthorizedAccessOrigin;
    }

    public function setUnauthorizedAccessOrigin(RedirectOrigin $unauthorizedAccessOrigin): VolatileQuery {
        $this->unauthorizedAccessOrigin = $unauthorizedAccessOrigin;
        return $this;
    }
}