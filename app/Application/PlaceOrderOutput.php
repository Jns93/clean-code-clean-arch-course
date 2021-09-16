<?php

namespace App\Application;

class PlaceOrderOutput
{
    //CLASS DTO
    public $freight;
    public $total;
    public $code;

    public function __construct($code, $freight, $total)
    {
        $this->code = $code;
        $this->freight = $freight;
        $this->total = $total;
    }
}
