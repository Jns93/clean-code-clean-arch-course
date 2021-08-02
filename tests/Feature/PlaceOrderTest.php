<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Entities\PlaceOrder;

class PlaceOrderTest extends TestCase
{
    public function test_place_order()
    {
        //DTO (data transfer object)
        $cpf = '778.278.412-36';

        $item['description'] = "Guitarra";
        $item['price'] = 1000;
        $item['quantity'] = 2;

        $item2['description'] = "Amplificador";
        $item2['price'] = 5000;
        $item2['quantity'] = 1;

        $item3['description'] = "Cabo";
        $item3['price'] = 30;
        $item3['quantity'] = 3;

        $coupon = 'VALE20';

        $input['cpf'] = $cpf;
        $input['items'] = array($item, $item2, $item3);
        $input['coupon'] = $coupon;

        $placeOrder = new PlaceOrder();
        $output = $placeOrder->execute($input);

        $this->assertEquals(5672, $output);

    }
}
