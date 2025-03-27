<?php

namespace App\Model;

use App\Service\Router;

class RedirectOrigin {

    protected ?string $origin = null;
    protected string $redirectName;
    protected array $params;

    public function isLabeledParam(string $paramName): bool {
        return str_starts_with($paramName, $this->redirectName . '_');
    }

    public function labelParams(): array {
        $labeled = array_map(function ($key) {
            return $this->getRedirectName() . '_' . $key;
        }, array_keys($this->getParams()));

        return array_combine($labeled, $this->getParams());
    }

    public function unlabelParams(array $labeled): void {
        $unlabeled = array_map(function ($key) {
            return explode($this->redirectName . '_', $key)[1];
        }, array_keys($labeled));

        $this->setParams(array_combine($unlabeled, $labeled));
    }

    public function getOrigin(): string {
        return $this->origin ?? Router::DEFAULT_CONTROLLER;
    }

    public function setOrigin(?string $origin): RedirectOrigin {
        $this->origin = $origin;
        return $this;
    }

    public function getRedirectName(): string {
        return $this->redirectName;
    }

    public function setRedirectName(string $redirectName): RedirectOrigin {
        $this->redirectName = $redirectName;
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