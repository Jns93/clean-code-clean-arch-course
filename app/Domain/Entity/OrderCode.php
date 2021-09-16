<?php

namespace App\Domain\Entity;

use Illuminate\Validation\ValidationException;
use Exception;

class OrderCode
{
    public $value;

    public function __construct($issueDate, int $sequence)
    {
        $this->value = $issueDate . str_pad($sequence, 8, '0', STR_PAD_LEFT);
    }
}
