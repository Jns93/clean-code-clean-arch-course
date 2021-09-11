<?php

namespace App\Infra\Database;

interface Database
{
    public function many();
    public function one($column, $params);
}
