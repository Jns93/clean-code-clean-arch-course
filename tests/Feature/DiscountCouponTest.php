<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Entities\DiscountCoupon;
use Illuminate\Validation\ValidationException;
use Exception;

class DiscountCouponTest extends TestCase
{
    public function test_discount_coupon_expired()
    {
        try {
            $expiredDate = '2000/01/01 00:00:00';
            $entityCoupon = new DiscountCoupon("VALE20", 20, $expiredDate);
            $this->fail();
        } catch (Exception $e) {
            $this->assertEquals('Cupom expirado', $e->getMessage());
        }

    }
}
