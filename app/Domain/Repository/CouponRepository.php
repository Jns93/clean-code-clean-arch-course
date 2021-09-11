<?php

namespace App\Domain\Repository;

interface CouponRepository
{
    public function getByCode(string $code);
}
