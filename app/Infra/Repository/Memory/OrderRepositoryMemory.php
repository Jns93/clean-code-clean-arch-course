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

    public function count()
    {
        return count($this->orders);
    }

    public function get($code)
    {
        foreach ($this->orders as $key => $value) {
            if ($value->code->value == $code) {
                return $this->orders[$key];
            }
        }
        return null;
    }
}
