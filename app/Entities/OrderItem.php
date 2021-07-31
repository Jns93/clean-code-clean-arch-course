<?php

namespace App\Entities;

use Illuminate\Validation\ValidationException;
use Exception;

class OrderItem
{
    public $description;
    public $price;
    public $quantity;

    public function __construct(string $description = null, float $price = null, int $quantity = null)
    {
        $this->$description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotal()
    {
        return $this->price * $this->quantity;
    }

}
