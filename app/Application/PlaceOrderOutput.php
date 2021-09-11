<?php

namespace App\Application;

class PlaceOrderOutput
{
    //CLASS DTO
    public $freight;
    public $total;

    public function __construct($freight, $total)
    {
        $this->freight = $freight;
        $this->total = $total;
    }
}
