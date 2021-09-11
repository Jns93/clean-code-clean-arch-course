<?php

namespace App\Infra\Gateway\Memory;

use App\Domain\Gateway\ZipcodeCalculatorAPI;

class ZipcodeCalculatorAPIMemory implements ZipcodeCalculatorAPI
{
    public function calculate(string $zipcodeA, string $zipcodeB)
    {
        return 1000;
    }
}
