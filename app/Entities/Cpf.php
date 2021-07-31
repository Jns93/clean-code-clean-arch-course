<?php

namespace App\Entities;

use Exception;


class Cpf
{
    public $cpf;

    public function __construct($value)
    {
        if (!$this->validateCPF($value)) throw new Exception("CPF is invalid");
        $this->cpf = $value;
    }

    public function validateCPF($cpf = "")
    {
        $cpf = $this->extractOnlyDigits($cpf);
        if ($this->isInvalidLength($cpf)) return false;
        if ($this->allDigitsAreEqual($cpf)) return false;
        $digit1 = $this->calulateVerifyingDigit($cpf, 10, 9);
        $digit2 = $this->calulateVerifyingDigit($cpf, 11, 10);
        $calculatedCheckDigit =  $digit1.$digit2;
        return $this->getCheckDigit($cpf) == $calculatedCheckDigit;
    }

    public function extractOnlyDigits($cpf)
    {
        return $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    }

    public function isInvalidLength($cpf)
    {
        return strlen($cpf) != 11;
    }

    public function allDigitsAreEqual($cpf)
    {
        return $cpf = preg_match('/(\d)\1{10}/', $cpf);
    }

    public function calulateVerifyingDigit($cpf, $multiplicationFactor, $lengthLimit)
    {
        $total = 0;
        for($i = 0; $i < $lengthLimit; $i++) {
            $total += intval($cpf[$i]) * $multiplicationFactor--;
        }
        $rest = $total % 11;
        $digit = ($rest < 2) ? 0 : (11 - $rest);
        return $digit;
    }

    public function getCheckDigit($cpf)
    {
        return substr($cpf, 9);
    }

}
