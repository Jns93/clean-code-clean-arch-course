<?php

namespace App\Domain\Entity;

use Illuminate\Validation\ValidationException;
use Exception;

class OrderItem
{
    public $code;
    public $price;
    public $quantity;

    public function __construct(string $code = null, float $price = null, int $quantity = null)
    {
        $this->code = $code;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotal()
    {
        return $this->price * $this->quantity;
    }

}
