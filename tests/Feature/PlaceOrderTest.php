<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Application\PlaceOrder;
use App\Infra\Memory\ItemRepositoryMemory;
use App\Infra\Memory\CouponRepositoryMemory;
use App\Infra\Memory\OrderRepositoryMemory;
use App\Infra\Gateway\Memory\ZipcodeCalculatorAPIMemory;
use App\Application\PlaceOrderInput;
use App\Infra\Repository\Database\ItemRepositoryDatabase;
use App\Infra\Database\QueryBuilderDatabase;

class PlaceOrderTest extends TestCase
{
    public function test_place_order_with_ItemRepositoryMemory()
    {
        $cpf = '778.278.412-36';
        $zipcode = '11.111-11';
        $item['code'] = 1;
        $item['quantity'] = 2;
        $item2['code'] = 2;
        $item2['quantity'] = 1;
        $item3['code'] = 3;
        $item3['quantity'] = 3;
        $coupon = 'VALE20';
        $input = new PlaceOrderInput($cpf, $zipcode, array($item, $item2, $item3), $coupon);

        $couponRepository = new CouponRepositoryMemory();
        $itemRepository = new ItemRepositoryMemory();
        $orderRepository = new OrderRepositoryMemory();
        $zipcodeCalculator = new ZipcodeCalculatorAPIMemory();
        $placeOrder = new PlaceOrder($itemRepository, $couponRepository, $orderRepository, $zipcodeCalculator);
        $output = $placeOrder->execute($input);
        $this->assertEquals(5982, $output->total);
    }

    public function test_place_order_with_ItemRepositoryDatabase()
    {
        $cpf = '778.278.412-36';
        $zipcode = '11.111-11';
        $item['code'] = 1;
        $item['quantity'] = 2;
        $item2['code'] = 2;
        $item2['quantity'] = 1;
        $item3['code'] = 3;
        $item3['quantity'] = 3;
        $coupon = 'VALE20';
        $input = new PlaceOrderInput($cpf, $zipcode, array($item, $item2, $item3), $coupon);

        $couponRepository = new CouponRepositoryMemory();
        $itemRepository = new ItemRepositoryDatabase(new QueryBuilderDatabase);
        $orderRepository = new OrderRepositoryMemory();
        $zipcodeCalculator = new ZipcodeCalculatorAPIMemory();
        $placeOrder = new PlaceOrder($itemRepository, $couponRepository, $orderRepository, $zipcodeCalculator);
        $output = $placeOrder->execute($input);
        $this->assertEquals(5982, $output->total);
    }

    public function test_place_order_with_expired_dicount_coupon()
    {
        $cpf = '778.278.412-36';
        $zipcode = '11.111-11';
        $item['code'] = 1;
        $item['quantity'] = 2;
        $item2['code'] = 2;
        $item2['quantity'] = 1;
        $item3['code'] = 3;
        $item3['quantity'] = 3;
        $coupon = 'VALE20_EXPIRED';

        $input = new PlaceOrderInput($cpf, $zipcode, array($item, $item2, $item3), $coupon);

        $couponRepository = new CouponRepositoryMemory();
        $itemRepository = new ItemRepositoryMemory();
        $orderRepository = new OrderRepositoryMemory();
        $zipcodeCalculator = new ZipcodeCalculatorAPIMemory();
        $placeOrder = new PlaceOrder($itemRepository, $couponRepository, $orderRepository, $zipcodeCalculator);
        $output = $placeOrder->execute($input);

        $this->assertEquals(7400, $output->total);

    }

    public function test_place_order_with_freight_calculator()
    {
        $cpf = '778.278.412-36';
        $zipcode = '11.111-11';
        $item['code'] = 1;
        $item['quantity'] = 2;
        $item2['code'] = 2;
        $item2['quantity'] = 1;
        $item3['code'] = 3;
        $item3['quantity'] = 3;
        $coupon = 'VALE20_EXPIRED';

        $input = new PlaceOrderInput($cpf, $zipcode, array($item, $item2, $item3), $coupon);

        $couponRepository = new CouponRepositoryMemory();
        $itemRepository = new ItemRepositoryMemory();
        $orderRepository = new OrderRepositoryMemory();
        $zipcodeCalculator = new ZipcodeCalculatorAPIMemory();
        $placeOrder = new PlaceOrder($itemRepository, $couponRepository, $orderRepository, $zipcodeCalculator);
        $output = $placeOrder->execute($input);
        $this->assertEquals(310, $output->freight);
    }
}
