<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Infra\Gateway\Memory\ZipcodeCalculatorAPIMemory;

class ZipCodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_calculate_distance_two_zipcodes()
    {
        $zipcodeCalculator = new ZipcodeCalculatorAPIMemory();
        $distance = $zipcodeCalculator->calculate('11.111-111', '99.999-999');
        $this->assertEquals(1000, $distance);
    }
}
