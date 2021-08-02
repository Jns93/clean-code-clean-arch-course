<?php

namespace App\Entities;

use Illuminate\Validation\ValidationException;
use Exception;

class DiscountCoupon
{
    public $code;
    public $percentageDiscount;

    public function __construct(string $code, int $percentageDiscount)
    {
        $this->setCoupon($code, $percentageDiscount);
    }

    protected function setCoupon($code, $percentageDiscount)
    {
        $this->code = $code;
        $this->percentageDiscount = $percentageDiscount;
    }
}
