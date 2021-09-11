<?php

namespace App\Infra\Memory;

use App\Domain\Repository\CouponRepository;
use App\Domain\Entity\DiscountCoupon;

class CouponRepositoryMemory implements CouponRepository
{
    public $coupons = [];

    public function __construct()
    {
        $this->coupons = [
            new DiscountCoupon("VALE20", 20, '2200/01/01 00:00:00'),
            new DiscountCoupon("VALE20_EXPIRED", 20, '1900/01/01 00:00:00')
        ];
    }

    public function getByCode(string $code)
    {
        foreach ($this->coupons as $key => $value) {
            if ($value->code == $code) {
                return $this->coupons[$key];
            }
        }
        return null;
    }
}
