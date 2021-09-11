<?php

namespace App\Domain\Repository;

interface ItemRepository
{
    public function getById(string $code);
}
