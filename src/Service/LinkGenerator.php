<?php

namespace App\Service;

final class LinkGenerator {

    public function generateLink(string $destination, array $params = []): string {
        $query = '';

        foreach ($params as $key => $value) {
            $query .= '&' . $key . '=' . $value;
        }

        return "?route=$destination$query";
    }
}