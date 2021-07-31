<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Entities\Cpf;
use Exception;


class CPFTest extends TestCase
{
    public function test_if_cpf_is_valid()
    {
        $entity = new Cpf('790.824.420-35');
        $this->assertEquals('790.824.420-35', $entity->cpf);
    }

    /**
     * @dataProvider getInvalidCPFs()
     */
    public function test_if_cpf_is_invalid($cpf)
    {
        try {
            $entity = new Cpf($cpf);
            $this->fail();
        } catch (Exception $e) {
            $this->assertEquals(
                'CPF is invalid', $e->getMessage()
            );
        }
    }

    public function getInvalidCPFs()
    {
        return [
            ['444.444.444-44'],
            ['123.123.123-55'],
            ['123.456.789-10']
        ];
    }
}
