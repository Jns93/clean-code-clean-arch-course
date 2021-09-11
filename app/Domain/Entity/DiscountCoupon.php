<?php

namespace App\Domain\Entity;

use Illuminate\Validation\ValidationException;
use Exception;

class DiscountCoupon
{
    public $code;
    public $percentageDiscount;
    public $expireDate;

    public function __construct(string $code, int $percentageDiscount, string $expireDate)
    {
        $this->setCoupon($code, $percentageDiscount, $expireDate);
    }

    protected function setCoupon($code, $percentageDiscount, $expireDate)
    {
        $this->code = $code;
        $this->percentageDiscount = $percentageDiscount;
        $this->expireDate = date("Y-m-d H:i:s", strtotime($expireDate));
    }

    public function isExpired()
    {
        $today = date("Y-m-d H:i:s");
        return ($this->expireDate < $today);
    }
}
