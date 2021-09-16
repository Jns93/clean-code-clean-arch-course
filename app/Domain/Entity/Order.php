<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Cpf;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Domain\Entity\OrderItem;
use App\Domain\Entity\OrderCode;

class Order
{
    private $cpf;
    private $coupon;
    public $freight;
    public $code;
    private $issueDate;
    private $sequence;

    public function __construct($cpf, $issueDate = "2050", int $sequence = 1)
    {
        $this->setCPF($cpf);
        $this->items = [];
        $this->freight = 0;
        $this->issueDate = $issueDate;
        $this->sequence = $sequence;
        $this->code = new OrderCode($issueDate, $sequence);
    }

    protected function setCPF($cpf)
    {
        $this->cpf = new Cpf($cpf);
    }

    public function addItem(string $code , float $price, int $quantity)
    {
        array_push($this->items, new OrderItem($code , $price, $quantity));
    }

    public function addDiscountCoupon($coupon)
    {
        if (!$coupon->isExpired()){
            $this->coupon = $coupon;
        }
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
        $total += $this->freight;
        return intval($total);
    }

}
