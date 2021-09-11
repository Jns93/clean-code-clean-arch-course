<?php

namespace App\Application;

class PlaceOrderInput
{
    //CLASS DTO
    public $cpf;
    public $zipcode;
    public $items;
    public $coupon;

    public function __construct($cpf, $zipcode, $items, $coupon)
    {
        $this->cpf = $cpf;
        $this->zipcode = $zipcode;
        $this->coupon = $coupon;
        foreach($items as $item) {
            $this->items[] = $item;
        }
    }

}
