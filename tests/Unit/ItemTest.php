<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Entity\Item;

class ItemTest extends TestCase
{
    public function test_volume_calculation_of_item()
    {
        $item = new Item("1", "Amplificador", 5000, 50, 50, 50, 22);
        $volume = $item->getVolume();
        $this->assertEquals(0.125, $volume);
    }

    public function test_density_calculation_of_item()
    {
        $item = new Item("1", "Amplificador", 5000, 50, 50, 50, 22);
        $density = $item->getDensity();
        $this->assertEquals(176, $density);
    }
}
