<?php

namespace App\Service;

use App\DI;

final class Message {

    private DI $di;
    private Router $router;

    private array $messages = [
        'auth_required' => 'Log in to access ${0}',
        'auth_invalid' => 'Invalid login or password',
        'auth_empty' => 'Please fill out login information'
    ];

    public function __construct() {
        $this->di = DI::getInstance();
        $this->router = $this->di->getSingletonService('router');
    }

    public function getMessage(string $id, array $args = []): string {
        return $this->processMessage($this->messages[$id], $args);
    }

    private function processMessage(string $message, array $args = []): string {
        for ($i = 0; $i < count($args); $i++) {
            $message = str_replace('${' . $i . '}', $args["message_arg$i"], $message);
        }

        $message = str_replace('${fullRoute}', $this->router->getFullRoute(), $message);

        return $message;
    }
}