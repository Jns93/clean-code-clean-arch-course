<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Entities\Order;
use Illuminate\Validation\ValidationException;
use Exception;

class OrderTest extends TestCase
{

    public function test_create_order_with_cpf_invalid()
    {
        try {
            $cpf = "444.444.444-44";
            $entityOrder = new Order($cpf);
            $this->fail();
        } catch (Exception $e) {
            $this->assertEquals(
                'CPF is invalid', $e->getMessage()
            );
        }
    }

    public function test_create_order_with_3_items()
    {
        $cpf = '790.824.420-35';
        $entityOrder = new Order($cpf);
        $entityOrder->addItem("Guitarra", 1000, 2);
        $entityOrder->addItem("Amplificador", 5000, 1);
        $entityOrder->addItem("Cabo", 30, 3);
        $total = $entityOrder->getTotal();
        $this->assertEquals(7090, $total);
    }
}
