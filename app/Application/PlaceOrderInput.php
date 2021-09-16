<?php

namespace App\Application;

class PlaceOrderInput
{
    //CLASS DTO
    public $cpf;
    public $zipcode;
    public $items;
    public $coupon;
    public $issueDate;

    public function __construct($cpf, $zipcode, $items, $coupon, $issueDate = '2050')
    {
        $this->cpf = $cpf;
        $this->zipcode = $zipcode;
        $this->coupon = $coupon;
        $this->issueDate = $issueDate;
        foreach($items as $item) {
            $this->items[] = $item;
        }
    }

}
