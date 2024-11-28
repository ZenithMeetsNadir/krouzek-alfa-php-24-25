<?php

namespace App\Controller;

class LogController extends BaseController {

    public function __construct() {
        $this->defaultAction = 'in';
    }

    public function inAction(): void {
        echo 'Action Log/in';
    }

    public function outAction(): void {
        echo 'Action Log/out';
    }

    public function upAction(): void {
        echo 'Action Log/up';
    }
}
