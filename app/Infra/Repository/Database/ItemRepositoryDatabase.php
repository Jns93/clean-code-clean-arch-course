<?php

namespace App\Infra\Repository\Database;

use App\Domain\Repository\ItemRepository;
use App\Domain\Entity\Item;
use App\Infra\Database\Database;

class ItemRepositoryDatabase implements ItemRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getById(string $code)
    {
       $item = $this->database->one('code', $code)->first();
       return new Item($item->code, $item->description, $item->price, $item->width, $item->height, $item->length, $item->weight);
    }
}
