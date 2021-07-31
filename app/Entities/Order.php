<?php

namespace App\Entities;

use App\Entities\Cpf;
use Illuminate\Validation\ValidationException;
use Exception;

class Order
{
    private $cpf;
    // private $items;

    public function __construct($cpf)
    {
        $this->setCPF($cpf);
        $this->items = [];
    }

    protected function setCPF($cpf)
    {
        $cpfEntity = new Cpf($cpf);
        // $response = $cpfEntity->validateCPF($cpf);
        // if(!$response) throw new Exception("CPF is invalid");
        // $this->cpf = $cpf;
    }

    public function addItem(string $description, float $price, int $quantity)
    {
        array_push($this->items, new OrderItem($description, $price, $quantity));
        // array_push($this->items, (object)[
        //     'description' => $description,
        //     'price' => $price,
        //     'quantity' => $quantity
        // ]);
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return intval($total);
    }
}
