<?php

namespace App\Service;

final class LinkGenerator {

    public function generateLink(?string $destination, array $params = []): string {
        $destination = $destination ? "route=$destination" : '';
        $query = '';

        foreach ($params as $key => $value) {
            $query .= "&$key=$value";
        }

        return "?$destination$query";
    }
}