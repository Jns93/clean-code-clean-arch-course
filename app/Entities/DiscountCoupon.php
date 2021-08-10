<?php

namespace App\Entities;

use Illuminate\Validation\ValidationException;
use Exception;

class DiscountCoupon
{
    public $code;
    public $percentageDiscount;
    public $expireAt;

    public function __construct(string $code, int $percentageDiscount, string $expireAt)
    {
        $this->setCoupon($code, $percentageDiscount, $expireAt);
    }

    protected function setCoupon($code, $percentageDiscount, $expireAt)
    {
        $this->code = $code;
        $this->percentageDiscount = $percentageDiscount;
        $this->$expireAt = $this->checkExpirationDate($expireAt);
    }

    protected function checkExpirationDate($expireAt)
    {
        $today = date("Y-m-d H:i:s");
        $expireAt = date("Y-m-d H:i:s", strtotime($expireAt));
        if($expireAt < $today) throw new Exception(" ");
        return $expireAt;
    }
}
