<?php

namespace App\View;

class View {

    public function render(string $route, array $data = []): void {
        extract($data);

        require __DIR__ . "/../../template/layout/header.phtml";

        include __DIR__ . "/../../template/$route.phtml";

        require __DIR__ . "/../../template/layout/footer.phtml";
    }
}