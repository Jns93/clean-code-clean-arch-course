<?php

namespace App\Domain\Entity;

class Item
{
    public $code;
    public $description;
    public $price;
    public $width;
    public $heigth;
    public $length;
    public $weight;

    public function __construct(string $code, string $description, float $price, float $width, float $heigth, float $length, float $weight)
    {

        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
        $this->width = $width;
        $this->heigth = $heigth;
        $this->length = $length;
        $this->weight = $weight;
    }

    public function getVolume()
    {
        return $this->width/100 * $this->heigth/100 * $this->length/100;
    }

    public function getDensity()
    {
        return $this->weight / $this->getVolume();
    }

}
