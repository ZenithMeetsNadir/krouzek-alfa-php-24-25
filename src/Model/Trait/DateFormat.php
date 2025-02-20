<?php

namespace App\Model\Trait;

use DateTime;

trait DateFormat {

    public function fromString(string $dateTime): DateTime {
        return DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
    }
}