<?php

namespace App\View;

use App\DI;
use App\Exception\TemplateNotFoundException;
use App\Service\LinkGenerator;
use App\Service\Message;

class View {

    private const HEADER_TEMPLATE = __DIR__ . "/../../template/layout/header.phtml";
    private const POPUP_TEMPLATE = __DIR__ . "/../../template/layout/popup.phtml";
    private const FOOTER_TEMPLATE = __DIR__ . "/../../template/layout/footer.phtml";

    private DI $di;
    private LinkGenerator $linkGenerator;
    private Message $message;

    public function __construct() {
        $this->di = DI::getInstance();
        $this->linkGenerator = $this->di->getSingletonService('linkGenerator');
        $this->message = $this->di->getSingletonService('message');
    }

    /**
     * @throws TemplateNotFoundException
     */
    public function render(string $fullRoute, array $data = []): void {
        extract($data);

        if (file_exists(self::HEADER_TEMPLATE))
            require self::HEADER_TEMPLATE;
        else
            throw new TemplateNotFoundException(
                "Header template " . self::HEADER_TEMPLATE . " not found."
            );

        if (!empty($message_id)) {
            if (file_exists(self::POPUP_TEMPLATE))
                require self::POPUP_TEMPLATE;
            else
                throw new TemplateNotFoundException(
                    "Popup template " . self::POPUP_TEMPLATE . " not found."
                );
        }

        include __DIR__ . "/../../template/$fullRoute.phtml";

        if (file_exists(self::FOOTER_TEMPLATE))
            require self::FOOTER_TEMPLATE;
        else
            throw new TemplateNotFoundException(
                "Footer template " . self::FOOTER_TEMPLATE . " not found."
            );
    }
}