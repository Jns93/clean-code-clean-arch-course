<?php

namespace App\Entities;

use App\Entities\Cpf;
use Illuminate\Validation\ValidationException;
use Exception;

class Order
{
    private $cpf;
    private $coupon;
    // private $items;

    public function __construct($cpf)
    {
        $this->setCPF($cpf);
        $this->items = [];
    }

    protected function setCPF($cpf)
    {
        $this->cpf = new Cpf($cpf);
    }

    public function addItem(string $description, float $price, int $quantity)
    {
        array_push($this->items, new OrderItem($description, $price, $quantity));
    }

    public function addDiscountCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        if ($this->coupon) {
            $total -= $total * ($this->coupon->percentageDiscount) / 100;
        }
        return intval($total);
    }

}
