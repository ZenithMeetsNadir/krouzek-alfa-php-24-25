<?php

namespace App\View;

use App\Exception\TemplateNotFoundException;

class View {

    private const HEADER_TEMPLATE = __DIR__ . "/../../template/layout/header.phtml";
    private const FOOTER_TEMPLATE = __DIR__ . "/../../template/layout/footer.phtml";

    public function render(string $route, array $data = []): void {
        extract($data);

        if (file_exists(self::HEADER_TEMPLATE))
            require self::HEADER_TEMPLATE;
        else
            throw new TemplateNotFoundException(
                "Header template " . self::HEADER_TEMPLATE . " not found."
            );

        include __DIR__ . "/../../template/$route.phtml";

        if (file_exists(self::FOOTER_TEMPLATE))
            require self::FOOTER_TEMPLATE;
        else
            throw new TemplateNotFoundException(
                "Footer template " . self::HEADER_TEMPLATE . " not found."
            );
    }
}