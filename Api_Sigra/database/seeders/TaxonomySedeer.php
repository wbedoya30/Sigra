<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('taxonomys')->insert([
            [
                'bloom_level' => 'Recordar',
            ],
            [
                'bloom_level' => 'Entender',
            ],
            [
                'bloom_level' => 'Aplicar',
            ],
            [
                'bloom_level' => 'Analizar',
            ],
            [
                'bloom_level' => 'Evaluar',
            ],
            [
                'bloom_level' => 'Crear',
            ],
        ]);
    }
}
