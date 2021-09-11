<?php

namespace App\Infra\Database;

use App\Infra\Database\Database;
use Illuminate\Support\Facades\DB;

class QueryBuilderDatabase implements Database
{
    public function many()
    {
        return DB::table('itens')
                ->get();
    }

    public function one($column, $param)
    {
        return DB::table('itens')
                ->where($column, $param)
                ->get();
    }
}
