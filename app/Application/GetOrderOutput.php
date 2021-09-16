<?php

namespace App\Application;

class GetOrderOutput
{
    //CLASS DTO
    public $freight;
    public $total;
    public $code;
    public $orderItems;

    public function __construct($code, $freight, $total, $orderItems)
    {
        $this->code = $code;
        $this->freight = $freight;
        $this->total = $total;
        $this->orderItems = $orderItems;
    }
}
