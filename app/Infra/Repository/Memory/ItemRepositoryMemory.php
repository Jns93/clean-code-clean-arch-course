<?php

namespace App\Infra\Memory;

use App\Domain\Repository\ItemRepository;
use App\Domain\Entity\Item;

class ItemRepositoryMemory implements ItemRepository
{
    public $items = [];

    public function __construct()
    {
        $this->items = [
            new Item(1, 'Guitarra', 1000, 100, 50, 15, 3),
            new Item(2, 'Amplificador', 5000, 50, 50, 50, 22),
            new Item(3, 'Cabo', 30, 10, 10, 10, 1)
        ];
    }

    public function getById(string $code)
    {
        foreach ($this->items as $key => $value) {
            if ($value->code == $code) {
                return $this->items[$key];
            }
        }
        return null;
    }
}
