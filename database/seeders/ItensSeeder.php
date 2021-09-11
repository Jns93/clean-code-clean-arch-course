<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('itens')->insert([
            'code' => 1,
            'description' => 'Guitarra',
            'price' => 1000,
            'height' => 100,
            'width' => 50,
            'length' => 15,
            'weight' => 3,
        ]);
        DB::table('itens')->insert([
            'code' => 2,
            'description' => 'Amplificador',
            'price' => 5000,
            'height' => 50,
            'width' => 50,
            'length' => 50,
            'weight' => 22,
        ]);
        DB::table('itens')->insert([
            'code' => 3,
            'description' => 'Cabo',
            'price' => 30,
            'height' => 10,
            'width' => 10,
            'length' => 10,
            'weight' => 1,
        ]);
    }
}
