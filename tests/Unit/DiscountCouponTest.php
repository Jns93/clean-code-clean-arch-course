<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Entity\DiscountCoupon;

class DiscountCouponTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_expired_coupom()
    {
        $coupon = new DiscountCoupon('VALE20', 20, '2000/01/01 00:00:00');
        $this->assertEquals($coupon->isExpired(), true);
    }
}
