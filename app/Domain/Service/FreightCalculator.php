<?php

namespace App\Domain\Service;

class FreightCalculator
{
    public static function calculate($distance, $item)
    {
        $price = $distance * $item->getVolume() * ($item->getDensity()/100);
        return ($price > 10) ? $price : 10;
    }
}
