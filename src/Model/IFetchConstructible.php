<?php

namespace App\Model;

interface IFetchConstructible {

    public function constructFrom(array $fetchData): mixed;
}