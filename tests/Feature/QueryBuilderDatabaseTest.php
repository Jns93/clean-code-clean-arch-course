<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Infra\Database\QueryBuilderDatabase;

class QueryBuilderDatabaseTest extends TestCase
{
    public function test_listar_todos_os_itens_usando_QueryBuilder()
    {
        $database = new QueryBuilderDatabase();
        $itens = $database->many();

        $this->assertCount(3, $itens);
    }

    public function test_pegar_um_item_especifico_usando_QueryBuilder()
    {
        $database = new QueryBuilderDatabase();
        $item = $database->one('description', 'Cabo')->pluck('description');

        $this->assertContains('Cabo', $item);
    }
}
