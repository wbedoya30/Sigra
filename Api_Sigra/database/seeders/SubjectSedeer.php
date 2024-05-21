<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('subjects')->insert([
            [
                'name' => 'Simulacion',
                'code' => '1',
                'credits' => '1',
                'description' => '1',
            ],
            [
                'name' => 'Ingles',
                'code' => '2',
                'credits' => '2',
                'description' => '2',
            ],
            [
                'name' => 'ADA',
                'code' => '3',
                'credits' => '3',
                'description' => '3',
            ],
        ]);
    }
}
