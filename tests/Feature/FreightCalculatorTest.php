<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Entity\Item;
use App\Domain\Service\FreightCalculator;

class FreightCalculatorTest extends TestCase
{
    public function test_freight_calculator()
    {
        $item = new Item("1", "Amplificador", 5000, 50, 50, 50, 22);
        $distance = 1000;
        $price = FreightCalculator::calculate($distance, $item);
        $this->assertEquals(220, $price);
    }

    public function test_freight_calculator_cable()
    {
        $item = new Item("3", "Cabo", 30, 9, 9, 9, 0.1);
        $distance = 1000;
        $price = FreightCalculator::calculate($distance, $item);
        $this->assertEquals(10, $price);
    }
}
