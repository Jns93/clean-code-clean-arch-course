<?php

namespace App\Infra\Memory;

use App\Domain\Repository\OrderRepository;

class OrderRepositoryMemory implements OrderRepository
{
    public $orders = [];

    public function __construct()
    {
        $this->orders = [];
    }

    public function save($order)
    {
        array_push($this->orders, $order);
    }
}
