<?php

namespace App\Model;

class RedirectOrigin {

    protected string $origin;
    protected string $redirectType;
    protected array $params;

    public function getOrigin(): string {
        return $this->origin;
    }

    public function setOrigin(string $origin): RedirectOrigin {
        $this->origin = $origin;
        return $this;
    }

    public function getRedirectType(): string {
        return $this->redirectType;
    }

    public function setRedirectType(string $redirectType): RedirectOrigin {
        $this->redirectType = $redirectType;
        return $this;
    }

    public function getParams(): array {
        return $this->params;
    }

    public function setParams(array $params): RedirectOrigin {
        $this->params = $params;
        return $this;
    }

}