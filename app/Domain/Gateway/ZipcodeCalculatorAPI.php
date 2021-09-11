<?php

namespace App\Domain\Gateway;

interface ZipcodeCalculatorAPI
{
    //IMPLEMENTACAO FAKE
    public function calculate(string $zipcodeA, string $zipcodeB);
}
