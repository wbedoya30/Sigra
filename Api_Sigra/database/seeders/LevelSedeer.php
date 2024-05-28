<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('levels')->insert([
            //1,recordar, 2,entender,3,aplicar,4,analizar,5, evaluar,6,crear"
            [
                'verb' => 'Apuntar',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'Definir',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'Describir',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'Encontrar',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'Identificar',
                'taxonomy_level' => 1,
            ],
            [
                'verb' => 'Completar',
                'taxonomy_level' => 2,
            ],
            [
                'verb' => 'Descubrir',
                'taxonomy_level' => 2,
            ],
            [
                'verb' => 'Aplicar',
                'taxonomy_level' => 3,
            ], 
            [
                'verb' => 'Clasificar',
                'taxonomy_level' => 3,
            ],
            [
                'verb' => 'Construir',
                'taxonomy_level' => 3,
            ], 
            [
                'verb' => 'Analizar',
                'taxonomy_level' => 4,
            ],
            [
                'verb' => 'Calcular',
                'taxonomy_level' => 4,
            ],
            [
                'verb' => 'Catalogar',
                'taxonomy_level' => 4,
            ],
            [
                'verb' => 'Categorizar',
                'taxonomy_level' => 4,
            ],
            [
                'verb' => 'Comparar',
                'taxonomy_level' => 4,
            ],
            [
                'verb' => 'Arreglar',
                'taxonomy_level' => 5,
            ],
            [
                'verb' => 'Cambiar',
                'taxonomy_level' => 5,
            ],
            [
                'verb' => 'Coleccionar',
                'taxonomy_level' => 5,
            ],
            [
                'verb' => 'Componer',
                'taxonomy_level' => 5,
            ],
            [
                'verb' => 'Actualizar',
                'taxonomy_level' => 6,
            ],
            [
                'verb' => 'Apreciar',
                'taxonomy_level' => 6,
            ],
            [
                'verb' => 'Calificar',
                'taxonomy_level' => 6,
            ],
            [
                'verb' => 'Combinar',
                'taxonomy_level' => 6,
            ],
            [
                'verb' => 'Elaborar',
                'taxonomy_level' => 6,
            ],        
         ]);
    }
}
