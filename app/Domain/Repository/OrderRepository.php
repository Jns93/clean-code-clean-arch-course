<?php

namespace App\Domain\Repository;

use App\Entities\Order;

interface OrderRepository
{
    public function save($order);
    public function count();
    public function get($code);
}
