<?php

namespace App\Service;

final class OriginInteraction {

    public array $disallowAuthOriginCreation = [
        'sign/in',
        'sign/out',
    ];
}